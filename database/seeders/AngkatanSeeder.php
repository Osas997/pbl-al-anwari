<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Angkatan::create([
            "tahun_angkatan" => "2022",
        ]);
        Angkatan::create([
            "tahun_angkatan" => "2023",
        ]);
        Angkatan::create([
            "tahun_angkatan" => "2024",
        ]);
        Angkatan::create([
            "tahun_angkatan" => "2025",
        ]);
    }
}
