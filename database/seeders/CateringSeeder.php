<?php

namespace Database\Seeders;

use App\Models\Catering;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CateringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catering::create([
            "jumlah_catering" => 1,
            "biaya" => 50000
        ]);

        Catering::create([
            "jumlah_catering" => 2,
            "biaya" => 10000
        ]);
    }
}
