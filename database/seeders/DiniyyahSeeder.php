<?php

namespace Database\Seeders;

use App\Models\Diniyyah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiniyyahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diniyyah::create([
            "nama_tingkatan" => "GUS",
            "kelas" => "1",
        ]);

        Diniyyah::create([
            "nama_tingkatan" => "GUS",
            "kelas" => "2",
        ]);

        Diniyyah::create([
            "nama_tingkatan" => "GUS",
            "kelas" => "3",
        ]);
    }
}
