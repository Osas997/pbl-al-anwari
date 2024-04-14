<?php

namespace Database\Factories;

use App\Models\Angkatan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Syahriyyah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_santri' => fake()->name,
            'nis' => fake()->unique()->numerify('##########'),
            'password' => bcrypt(fake()->password),
            'no_nik' => fake()->unique()->numerify('################'),
            'no_hp' => fake()->numerify('08##########'),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tempat_lahir' => fake()->city,
            'tgl_lahir' => fake()->date,
            'alamat' => fake()->address,
            'nama_ayah' => fake()->name('male'),
            'nama_ibu' => fake()->name('female'),
            'status' => fake()->randomElement(['Aktif', 'Lulus', 'Tidak Lulus']),
            'id_syahriyyah' => function () {
                return Syahriyyah::inRandomOrder()->first()->id;
            },
            'id_catering' => function () {
                return Catering::inRandomOrder()->first()->id;
            },
            'id_angkatan' => function () {
                return Angkatan::inRandomOrder()->first()->id;
            },
            'id_diniyyah' => function () {
                return Diniyyah::inRandomOrder()->first()->id;
            },
        ];
    }
}
