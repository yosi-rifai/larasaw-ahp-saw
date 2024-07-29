<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\Alternative;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        $rankings = Ranking::all();
        return view('rankings.index', compact('rankings'));
    }

    public function create()
    {
        $alternatives = Alternative::with('hotel')->get();
        $existingRankings = Ranking::pluck('alternative_id')->toArray();
        return view('rankings.create', compact('alternatives', 'existingRankings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternative_id_type' => 'required|in:single,multiple',
            'alternative_id_single' => 'required_if:alternative_id_type,single|exists:alternatives,id',
            'alternative_id' => 'required_if:alternative_id_type,multiple|array',
            'alternative_id.*' => 'exists:alternatives,id',
        ]);

        if ($request->input('alternative_id_type') === 'single') {
            $alternative_ids = [$request->input('alternative_id_single')];
        } else {
            $alternative_ids = $request->input('alternative_id');
        }

        foreach ($alternative_ids as $alternative_id) {
            if (Ranking::where('alternative_id', $alternative_id)->exists()) {
                continue;
            }

            // Calculate AHP and get score and priorityVector
            $result = $this->calculateAHP($alternative_id);

            if ($result === null) {
                continue; // Skip if calculation returned null
            }

            [$score, $result_c1, $result_c2, $result_c3, $result_c4, $result_c5] = $result;

            // Simpan hasil ke tabel rankings
            $ranking = new Ranking();
            $ranking->alternative_id = $alternative_id;
            $ranking->score = $score;
            $ranking->c1 = $result_c1;
            $ranking->c2 = $result_c2;
            $ranking->c3 = $result_c3;
            $ranking->c4 = $result_c4;
            $ranking->c5 = $result_c5;
            $ranking->save();
            }

        return redirect()->route('rankings.index')->with('success', 'Ranking created successfully');
    }

    private function calculateAHP($alternative_id)
    {
        // Ambil data alternatif dari database
        $alternative = Alternative::find($alternative_id);

        // Asumsikan nilai c1, c2, c3, c4, dan c5 sudah ada di model Alternative
        $c1 = $alternative->c1;
        $c2 = $alternative->c2;
        $c3 = $alternative->c3;
        $c4 = $alternative->c4;
        $c5 = $alternative->c5;

        // Bobot perbandingan kriteria
        $comparisonMatrix = [
            [1, 2, 3, 4, 5],   // c1 dibanding c2, c3, c4, c5
            [1/2, 1, 3, 5, 1],
            [1/3, 1/3, 1, 2, 1], 
            [1/4, 1/5, 1/2, 1, 1], 
            [1/5, 1, 1, 1, 1],
        ];

        // Normalisasi matriks perbandingan
        $sumColumns = array_map(function($colIndex) use ($comparisonMatrix) {
            return array_sum(array_column($comparisonMatrix, $colIndex));
        }, array_keys($comparisonMatrix[0]));

        $normalizedMatrix = array_map(function($row) use ($sumColumns) {
            return array_map(function($value, $colIndex) use ($sumColumns) {
                return $value / $sumColumns[$colIndex];
            }, $row, array_keys($row));
        }, $comparisonMatrix);

        // Hitung vektor prioritas
        $priorityVector = array_map(function($row) {
            return array_sum($row) / count($row);
        }, $normalizedMatrix);

        // dd($normalizedMatrix, $sumColumns, $priorityVector);

        $result_c1 = $priorityVector[0] * $c1;
        $result_c2 = $priorityVector[1] * $c2;
        $result_c3 = $priorityVector[2] * $c3;
        $result_c4 = $priorityVector[3] * $c4;
        $result_c5 = $priorityVector[4] * $c5;

        // Hitung skor akhir berdasarkan bobot kriteria
        $finalScore = ($priorityVector[0] * $c1) + ($priorityVector[1] * $c2) + ($priorityVector[2] * $c3) + ($priorityVector[3] * $c4) + ($priorityVector[4] * $c5);

        return [$finalScore, $result_c1, $result_c2, $result_c3, $result_c4, $result_c5];
    }

    public function show(Ranking $ranking)
    {
        return view('rankings.show', compact('ranking'));
    }

    public function edit(Ranking $ranking)
    {
        return view('rankings.edit', compact('ranking'));
    }

    public function update(Request $request, Ranking $ranking)
    {
        $request->validate([
            'alternative_id' => 'required|exists:alternatives,id',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        $ranking->update($request->all());

        return redirect()->route('rankings.index')
            ->with('success', 'Ranking updated successfully.');
    }

    public function destroy(Ranking $ranking)
    {
        $ranking->delete();

        return redirect()->route('rankings.index')
            ->with('success', 'Ranking deleted successfully.');
    }
}
