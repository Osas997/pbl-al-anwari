<?php

namespace Tests\Feature\Livewire\Admin\Santri;

use App\Livewire\Admin\Santri\SantriCreate;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Santri;
use App\Models\Syahriyyah;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SantriCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test data
        Diniyyah::insert([
            ["id" => "1", "nama_tingkatan" => "ULA", "kelas" => "1"],
            ["id" => "2", "nama_tingkatan" => "ULA", "kelas" => "2"]
        ]);

        Catering::insert([
            ["id" => "1", "jumlah_catering" => 1, "biaya" => 100_000],
            ["id" => "2", "jumlah_catering" => 2, "biaya" => 200_000]
        ]);

        Syahriyyah::insert([
            ["id" => "1", "jenis_domisili" => "mukim", "biaya" => 100_000],
            ["id" => "2", "jenis_domisili" => "non mukim", "biaya" => 50_000]
        ]);
    }


    /** @test */
    public function can_create_new_santri()
    {
        Livewire::test(SantriCreate::class)
            ->set('nama_santri', 'John Doe')
            ->set('nama_ayah', 'John Doe Sr.')
            ->set('nama_ibu', 'Jane Doe')
            ->set('tempat_lahir', 'Jakarta')
            ->set('tgl_lahir', '1990-01-01')
            ->set('alamat', '123 Main St, Jakarta')
            ->set('jenis_kelamin', 'L')
            ->set('nis', '123456789012345678')
            ->set('no_hp', '081234567890')
            ->set('no_nik', '1234567890123456')
            ->set('id_syahriyyah', 1)
            ->set('id_diniyyah', 1)
            ->set('id_catering', 1)
            ->set('tahun_angkatan', 2022)
            ->call('store')
            ->assertDispatched('santri')
            ->assertDispatched('close-modal', 'create-santri-modal');

        $this->assertTrue(Santri::where('nama_santri', 'John Doe')->where('nis', '123456789012345678')->exists());
    }

    /** @test */
    public function nis_is_required()
    {
        Livewire::test(SantriCreate::class)
            ->set('nama_ayah', 'John Doe Sr.')
            ->set('nama_ibu', 'Jane Doe')
            ->set('tempat_lahir', 'Jakarta')
            ->set('tgl_lahir', '1990-01-01')
            ->set('alamat', '123 Main St, Jakarta')
            ->set('jenis_kelamin', 'L')
            ->set('nis', '123456789012345678')
            ->set('no_hp', '081234567890')
            ->set('no_nik', '1234567890123456')
            ->set('id_syahriyyah', 1)
            ->set('id_diniyyah', 1)
            ->set('id_catering', 1)
            ->set('tahun_angkatan', 2022)
            ->call('store')
            ->assertHasErrors(['nama_santri' => 'required']);
    }

    /** @test */
    public function nik_is_required()
    {
        Livewire::test(SantriCreate::class)
            ->set('nama_santri', 'John Doe')
            ->set('nama_ayah', 'John Doe Sr.')
            ->set('nama_ibu', 'Jane Doe')
            ->set('tempat_lahir', 'Jakarta')
            ->set('tgl_lahir', '1990-01-01')
            ->set('alamat', '123 Main St, Jakarta')
            ->set('jenis_kelamin', 'L')
            ->set('nis', '123456789012345678')
            ->set('no_hp', '081234567890')
            ->set('id_syahriyyah', 1)
            ->set('id_diniyyah', 1)
            ->set('id_catering', 1)
            ->set('tahun_angkatan', 2022)
            ->call('store')
            ->assertHasErrors(['no_nik' => 'required']);
    }

    /** @test */
    public function alamat_is_required()
    {
        Livewire::test(SantriCreate::class)
            ->set('nama_santri', 'John Doe')
            ->set('nama_ayah', 'John Doe Sr.')
            ->set('nama_ibu', 'Jane Doe')
            ->set('tempat_lahir', 'Jakarta')
            ->set('tgl_lahir', '1990-01-01')
            ->set('jenis_kelamin', 'L')
            ->set('nis', '123456789012345678')
            ->set('no_hp', '081234567890')
            ->set('no_nik', '1234567890123456')
            ->set('id_syahriyyah', 1)
            ->set('id_diniyyah', 1)
            ->set('id_catering', 1)
            ->set('tahun_angkatan', 2022)
            ->call('store')
            ->assertHasErrors(['alamat' => 'required']);
    }

    /** @test */
    public function all_column_is_required()
    {
        Livewire::test(SantriCreate::class)
            ->call('store')
            ->assertHasErrors([
                'nama_santri' => 'required',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'nis' => 'required',
                'no_hp' => 'required',
                'no_nik' => 'required',
                'id_syahriyyah' => 'required',
                'id_diniyyah' => 'required',
                'id_catering' => 'required',
                'tahun_angkatan' => 'required'
            ]);
    }
}