<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kriteria Harga (cost)
        Criteria::create([
            'nama' => 'harga',
            'bobot' => 0.3,
            'jenis' => 'cost'
        ]);

        // Kriteria Rating (benefit)
        Criteria::create([
            'nama' => 'rating',
            'bobot' => 0.2,
            'jenis' => 'benefit'
        ]);

        // Kriteria Fasilitas (benefit)
        Criteria::create([
            'nama' => 'fasilitas',
            'bobot' => 0.2,
            'jenis' => 'benefit'
        ]);

        // Kriteria Kemudahan Aksesibilitas (benefit)
        Criteria::create([
            'nama' => 'kemudahan_aksesibilitas',
            'bobot' => 0.1,
            'jenis' => 'benefit'
        ]);

        // Kriteria Kualitas Layanan (benefit)
        Criteria::create([
            'nama' => 'kualitas_layanan',
            'bobot' => 0.2,
            'jenis' => 'benefit'
        ]);
    }
}
