<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BankPondok;
use App\Models\Santri;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CateringSeeder::class,
            SyahriyyahSeeder::class,
            DiniyyahSeeder::class,
            IndoBankSeeder::class
        ]);

        Santri::factory(100)->create();

        Admin::create([
            "nama_admin" => "Admin Pondok",
            "username" => "admin",
            "password" => "admin",
        ]);

        BankPondok::create([
            "nama_bank" => "BANK MANDIRI",
            "sandi_bank" => "008",
            "nomor_rekening" => "1234567890",
            "nama_rekening" => "RUOK FF"
        ]);
    }
}
