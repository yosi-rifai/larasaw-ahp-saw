<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Hotel;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::with(['hotel', 'criteria'])->get();
        return view('alternatives.index', compact('alternatives'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        $criteria = Criteria::all();
        $existingAlternatives = Alternative::pluck('hotel_id')->toArray();
        return view('alternatives.create', compact('hotels', 'criteria', 'existingAlternatives'));
    }

    public function edit($id)
    {
        $alternative = Alternative::findOrFail($id);
        $hotels = Hotel::all();
        $criteria = Criteria::all();
        return view('alternatives.edit', compact('alternative', 'hotels', 'criteria'));
    }

    public function store(Request $request)
    {

    $request->validate([
        'hotel_selection_type' => 'required|in:single,multiple',
        'hotel_id_single' => 'required_if:hotel_selection_type,single|exists:hotels,id',
        'hotel_id' => 'required_if:hotel_selection_type,multiple|array',
        'hotel_id.*' => 'exists:hotels,id',
    ]);

    if ($request->input('hotel_selection_type') === 'single') {
        $hotelIds = [$request->input('hotel_id_single')];
    } else {
        $hotelIds = $request->input('hotel_id');
    }

    foreach ($hotelIds as $hotelId) {
        $this->runSAW($hotelId);
    }

    // Redirect atau response lainnya
    return redirect()->route('alternatives.index')->with('success', 'Perhitungan Metode SAW Selesai selesai');
    }

    private function runSAW($hotelId){
        $hotel = Hotel::findOrFail($hotelId);

        // Ambil semua data kriteria
        $criterias = Criteria::all();

        // Inisialisasi array untuk menyimpan preferensi untuk setiap kriteria
        $preferences = [];

        // Loop melalui setiap kriteria
        foreach ($criterias as $criteria) {
            if ($criteria->nama === 'fasilitas' || $criteria->nama === 'kemudahan_aksesibilitas' || $criteria->nama === 'kualitas_layanan') {
                $allJsonValues = Hotel::pluck($criteria->nama)->all();
                $lengths = array_map(function ($jsonValue) {
                    $decodedValue = json_decode($jsonValue, true);
                    return is_array($decodedValue) ? count($decodedValue) : 0;
                }, $allJsonValues);

                $minLength = min($lengths);
                $maxLength = max($lengths);

                $length = $hotel->{$criteria->nama};
                $jsonData = json_decode($length);
                $countJson = count($jsonData);
                $value = $countJson;

                $min = $minLength;
                $max = $maxLength;
            } else {
                $value = $hotel->{$criteria->nama};

                $min = Hotel::min($criteria->nama);
                $max = Hotel::max($criteria->nama);
            }


            // Tentukan apakah kriteria adalah cost atau benefit
            $isCost = $criteria->jenis === 'cost';

        // Hitung preferensi berdasarkan logika SAW
        if ($isCost) {
            if ($max != 0) {
                $preferensi = $min / $value;
            } else {
                $preferensi = 0;
            }
        } else { // Kriteria benefit
            if ($max != 0) {
                $preferensi = $value / $max;
            } else {
                $preferensi = 0;
            }
        }
        $preferences[$criteria->nama] = $preferensi * $criteria->bobot;
    }
    // dd($value, $min, $max, $preferences);

    $nilaiAkhir = array_sum($preferences);
    $c1 = $preferences['harga'];
    $c2 = $preferences['rating'];
    $c3 = $preferences['fasilitas'];
    $c4 = $preferences['kemudahan_aksesibilitas'];
    $c5 = $preferences['kualitas_layanan'];

    $existingAlternative = Alternative::where('hotel_id', $hotelId)->first();

    if ($existingAlternative) {
        $existingAlternative->nilai = round($nilaiAkhir, 2);
        $existingAlternative->save();
    } else {
        Alternative::create([
            'hotel_id' => $hotelId,
            'c1' => round($c1, 14),
            'c2' => round($c2, 14),
            'c3' => round($c3, 14),
            'c4' => round($c4, 14),
            'c5' => round($c5, 14),
            'nilai' => round($nilaiAkhir, 14),
        ]);
    }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'criteria_id' => 'required|exists:criteria,id',
            'nilai' => 'required|numeric|min:0|max:10',
        ]);

        $alternative = Alternative::findOrFail($id);
        $alternative->update($request->all());

        // Menjalankan perhitungan SAW setelah mengupdate data
        // $this->runSAW($hotelId);

        return redirect()->route('alternatives.index');
    }

    public function show($id)
    {
        $alternative = Alternative::findOrFail($id);
        return view('alternatives.show', compact('alternative'));
    }

    public function destroy($id)
    {
        Alternative::destroy($id);

        // Menjalankan perhitungan SAW setelah menghapus data
        // $this->runSAW($hotelId);

        return redirect()->route('alternatives.index');
    }

    public function deleteAll()
    {
        // Hapus semua data alternatif
        Alternative::truncate();

        // Redirect ke halaman atau route yang sesuai
        return redirect()->route('alternatives.index')->with('success', 'All alternatives have been deleted.');
    }
}
