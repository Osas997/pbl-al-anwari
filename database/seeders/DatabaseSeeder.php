<?php

namespace Database\Seeders;

use App\Models\Admin;
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
            RoleSeeder::class,
            CateringSeeder::class,
            SyahriyyahSeeder::class,
            AngkatanSeeder::class,
            DiniyyahSeeder::class,
        ]);

        Santri::factory(100)->create();

        $admin = Admin::create([
            "nama_admin" => "Admin Pondok",
            "username" => "admin",
            "password" => "admin",
        ]);

        $admin->assignRole('admin');
    }
}
