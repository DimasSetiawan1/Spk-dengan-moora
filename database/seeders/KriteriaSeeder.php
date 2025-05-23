<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            [
                'nama' => 'Kualitas',
                'bobot' => 0.25,
                'type' => 'benefit'
            ],
            [
                'nama' => 'Harga',
                'bobot' => 0.25,
                'type' => 'cost'
            ],
            [
                'nama' => 'Persediaan',
                'bobot' => 0.25,
                'type' => 'benefit'
            ],
            [
                'nama' => 'Pengiriman',
                'bobot' => 0.25,
                'type' => 'benefit'
            ]
        ];

        foreach ($kriteria as $k) {
           Kriteria::create($k);
        }
    }
}
