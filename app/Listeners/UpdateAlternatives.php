<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Models\Hotel;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Events\HotelUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateAlternatives
{
    public function handle(HotelUpdated $event)
    {
        $hotel = $event->hotel;

        Log::info('Hotel Updated Event Triggered.');
        Log::info('Hotel ID: ' . $hotel->id);
        Log::info('Nama Hotel: ' . $hotel->nama);

        // Mendapatkan semua kriteria dari tabel criteria
        $kriteria = Criteria::all();

        // Variabel untuk menyimpan nilai normalisasi untuk setiap kriteria
        $normalisasiValues = [];

        // Loop untuk setiap kriteria
        foreach ($kriteria as $criteria) {
            // Mendapatkan nilai setiap alternatif dari hotel yang baru saja diperbarui
            $nilaiAlternatif = $hotel->{$criteria->nama};

            // Normalisasi nilai untuk kriteria benefit
            if ($criteria->jenis === 'benefit') {
                // Mendapatkan nilai maksimum dari kriteria
                $maxValue = Hotel::max($criteria->nama);
                // Normalisasi nilai
                if($maxValue != 0) {
                    $normalisasiValues[$criteria->id] = $nilaiAlternatif / $maxValue;
                } else {
                    $normalisasiValues[$criteria->id] = 0;
                }
            }
            // Normalisasi nilai untuk kriteria cost
            else {
                // Mendapatkan nilai minimum dari kriteria
                $minValue = Hotel::min($criteria->nama);
                // Normalisasi nilai
                if($nilaiAlternatif != 0) {
                    $normalisasiValues[$criteria->id] = $minValue / $nilaiAlternatif;
                } else {
                    $normalisasiValues[$criteria->id] = 0;
                }
            }
        }

        // Menyimpan nilai normalisasi ke dalam tabel alternatives
        foreach ($normalisasiValues as $criteriaId => $normalisasi) {
            $alternative = new Alternative();
            $alternative->hotel_id = $hotel->id;
            $alternative->criteria_id = $criteriaId;
            $alternative->nilai = $normalisasi;
            $alternative->save();
        }
    }
}
