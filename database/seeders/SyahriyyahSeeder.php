<?php

namespace Database\Seeders;

use App\Models\Syahriyyah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SyahriyyahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Syahriyyah::create([
            "jenis_domisili" => "Mukim",
            "biaya" => 100_000
        ]);

        Syahriyyah::create([
            "jenis_domisili" => "Non Mukim",
            "biaya" => 50_000
        ]);
    }
}
