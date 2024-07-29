<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Hotel;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Events\HotelUpdated;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);;
    }

    public function index()
    {
        $hotels = Hotel::paginate(10);
        return view('hotels.index', compact('hotels'));
    }

    public function detail(){
        $hotels = Hotel::all();
        return view('hotels.detail', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'harga' => 'required',
            'rating' => 'required',
            'hotel_image_url' => 'image|mimes:jpeg,png,jpg,gif|max:3210|nullable',
        ]);


        $imageName = 'hotel_default.jpg';

        if ($request->hasFile('hotel_image_url')) {
            $image = $request->file('hotel_image_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/hotels/');
            $image->move($destinationPath, $name);
            $imageName = $name;
        }

        $hotel = Hotel::create([
            'nama' => $request->nama,
            'hotel_image_url' => $imageName,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'rating' => $request->rating,
            'kualitas_layanan' => json_encode($request->kualitas_layanan),
            'fasilitas' => json_encode($request->fasilitas),
            'kemudahan_aksesibilitas' => json_encode($request->kemudahan_aksesibilitas),
        ]);

        $hotel->save();

        return redirect()->route('hotels.index')
                         ->with('success','Hotel created successfully.');
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request,$id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'lokasi' => 'required',
                'harga' => 'required|integer',
                'rating' => 'required|numeric|between:0,5',
                'hotel_image_url' => 'image|mimes:jpeg,png,jpg,gif|max:3210|nullable',
                'kualitas_layanan' => 'required|array',
                'kualitas_layanan.*' => 'string',
                'fasilitas' => 'required|array',
                'fasilitas.*' => 'string',
                'kemudahan_aksesibilitas' => 'required|array',
                'kemudahan_aksesibilitas.*' => 'string',
            ]);

            $hotel = Hotel::findOrFail($id);

            // Update data hotel
            $hotel->nama = $request->nama;
            $hotel->lokasi = $request->lokasi;
            $hotel->harga = $request->harga;
            $hotel->rating = $request->rating;

            // Handle upload gambar jika ada
            if ($request->hasFile('hotel_image_url')) {
                $image = $request->file('hotel_image_url');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/hotels/');
                $image->move($destinationPath, $imageName);

                // Hapus gambar lama jika ada
                if ($hotel->hotel_image_url && file_exists(public_path('images/hotels/' . $hotel->hotel_image_url))) {
                    unlink(public_path('images/hotels/' . $hotel->hotel_image_url));
                }

                $hotel->hotel_image_url = $imageName;
            }

            $hotel->fasilitas = json_encode($request->fasilitas ?? []);
            $hotel->kualitas_layanan = json_encode($request->kualitas_layanan ?? []);
            $hotel->kemudahan_aksesibilitas = json_encode($request->kemudahan_aksesibilitas ?? []);

            $hotel->save();
            return redirect()->route('hotels.index')->with('success', 'Hotel updated successfully.');
        } catch (Throwable $th) {
            Log::error('Error updating hotel: ' . $th->getMessage());
            return redirect()->route('hotels.index')->with('success', 'Hotel Updated successfully');
        }
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('hotels.index')
                         ->with('success', 'Hotel deleted successfully.');
    }
}
