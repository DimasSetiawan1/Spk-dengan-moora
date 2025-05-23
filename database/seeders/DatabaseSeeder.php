<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mochamad Dimas Setiawan',
            'username' => 'Dimas123',
            'email' => 'dimas@gmail.com',
            'role' => 'superadmin',
            'password' => Hash::make('Password'),
        ]);
        User::factory()->create([
            'name' => 'Rizhty Hairunisyah',
            'username' => 'Rizhty123',
            'role' => 'admin',
            'email' => 'risti@gmail.com',
            'password' => Hash::make('Password'),
        ]);
        User::factory()->create([
            'name' => 'Dhiaul Furqan',
            'username' => 'Dhiaul123',
            'role' => 'user',
            'email' => 'dhiaul@gmail.com',
            'password' => Hash::make('Password'),
        ]);
        $kriteria = [
            [
                'code' => 'C1',
                'name' => 'Kualitas',
                'bobot' => 0.25,
                'keterangan' => true
            ],
            [
                'code' => 'C2',
                'name' => 'Harga ($/L)',
                'bobot' => 0.25,
                'keterangan' => false
            ],
            [
                'code' => 'C3',
                'name' => 'Persediaan',
                'bobot' => 0.25,
                'keterangan' => true
            ],
            [
                'code' => 'C4',
                'name' => 'Pengiriman (Hari)',
                'bobot' => 0.25,
                'keterangan' => true
            ]
        ];
        for ($i = 0; $i < 10; $i++) {
            Supplier::create([
                'code' => 'S' . $i,
                'name' => fake()->company(),
            ],);
        }

        foreach ($kriteria as $k) {
            Kriteria::create($k);
        }
    }
}
