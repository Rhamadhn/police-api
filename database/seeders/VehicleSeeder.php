<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            [
                'user_id' => 1,
                'license_plate' => 'AB 1234 CD',
                'type' => 'Mobil',
                'brand' => 'Toyota',
                'color' => 'Hitam',
                'is_stolen' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'license_plate' => 'EF 5678 GH',
                'type' => 'Motor',
                'brand' => 'Honda',
                'color' => 'Merah',
                'is_stolen' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'license_plate' => 'IJ 9012 KL',
                'type' => 'Mobil',
                'brand' => 'BMW',
                'color' => 'Putih',
                'is_stolen' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
