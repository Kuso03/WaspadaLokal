<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Jakarta', 'lat' => -6.2088, 'lon' => 106.8456],
            ['name' => 'Surabaya', 'lat' => -7.2504, 'lon' => 112.7688],
            ['name' => 'Bandung', 'lat' => -6.9147, 'lon' => 107.6098],
            ['name' => 'Medan', 'lat' => 3.5952, 'lon' => 98.6722],
            ['name' => 'Semarang', 'lat' => -6.9666, 'lon' => 110.4166],
            ['name' => 'Makassar', 'lat' => -5.1476, 'lon' => 119.4327],
            ['name' => 'Sukoharjo', 'lat' => -7.6744, 'lon' => 110.8333],
            ['name' => 'Denpasar', 'lat' => -8.6500, 'lon' => 115.2166]
        ];

        foreach ($cities as $city) {
            \App\Models\City::create($city);
        }
    }
}
