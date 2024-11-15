<?php

namespace Tests\Feature\Livewire\Admin\Santri;

use App\Livewire\Admin\Santri\SantriEdit;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Santri;
use App\Models\Syahriyyah;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SantriEditTest extends TestCase
{
    use RefreshDatabase;

    protected $santri;

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

        // Create a test santri
        $this->santri = Santri::create([
            'nama_santri' => 'John Doe',
            'nama_ayah' => 'John Doe Sr.',
            'nama_ibu' => 'Jane Doe',
            'tempat_lahir' => 'Jakarta',
            'tgl_lahir' => '1990-01-01',
            'alamat' => '123 Main St, Jakarta',
            'jenis_kelamin' => 'L',
            'nis' => '123456789012345678',
            'no_hp' => '081234567890',
            'no_nik' => '1234567890123456',
            'id_syahriyyah' => 1,
            'id_diniyyah' => 1,
            'id_catering' => 1,
            'tahun_angkatan' => 2022,
            'password' => bcrypt('password')
        ]);
    }


    /** @test */
    public function can_update_santri()
    {
        Livewire::test(SantriEdit::class)
            ->call('edit', $this->santri->id)
            ->set('nama_santri', 'Updated Name')
            ->set('nama_ayah', 'Updated Father')
            ->set('nama_ibu', 'Updated Mother')
            ->set('tempat_lahir', 'Updated City')
            ->set('tgl_lahir', '2001-02-02')
            ->set('alamat', 'Updated Address')
            ->set('jenis_kelamin', 'P')
            ->set('nis', '876543210987654321')
            ->set('no_hp', '089876543210')
            ->set('no_nik', '9876543210123456')
            ->set('id_syahriyyah', 2)
            ->set('id_diniyyah', 2)
            ->set('id_catering', 2)
            ->set('tahun_angkatan', 2023)
            ->call('update')
            ->assertDispatched('santri')
            ->assertDispatched('close-modal', 'edit-santri-modal');

        $this->assertDatabaseHas('santri', [
            'id' => $this->santri->id,
            'nama_santri' => 'Updated Name',
            'nama_ayah' => 'Updated Father',
            'nama_ibu' => 'Updated Mother',
            'tempat_lahir' => 'Updated City',
            'tgl_lahir' => '2001-02-02',
            'alamat' => 'Updated Address',
            'jenis_kelamin' => 'P',
            'nis' => '876543210987654321',
            'no_hp' => '089876543210',
            'no_nik' => '9876543210123456',
            'id_syahriyyah' => 2,
            'id_diniyyah' => 2,
            'id_catering' => 2,
            'tahun_angkatan' => 2023
        ]);
    }

    /** @test */
    public function validates_required_fields()
    {
        Livewire::test(SantriEdit::class)
            ->call('edit', $this->santri->id)
            ->set('nama_santri', '')
            ->set('nama_ayah', '')
            ->set('nama_ibu', '')
            ->set('tempat_lahir', '')
            ->set('tgl_lahir', '')
            ->set('alamat', '')
            ->set('jenis_kelamin', '')
            ->set('nis', '')
            ->set('no_hp', '')
            ->set('no_nik', '')
            ->set('id_syahriyyah', '')
            ->set('id_diniyyah', '')
            ->set('id_catering', '')
            ->set('tahun_angkatan', '')
            ->call('update')
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

    /** @test */
    public function validates_unique_fields_except_current_record()
    {
        // Create another santri for unique validation testing
        $otherSantri = Santri::create([
            'nama_santri' => 'Other Santri',
            'nama_ayah' => 'Other Father',
            'nama_ibu' => 'Other Mother',
            'tempat_lahir' => 'Other City',
            'tgl_lahir' => '2000-01-01',
            'alamat' => 'Other Address',
            'jenis_kelamin' => 'L',
            'nis' => '111111111111111111',
            'no_hp' => '081111111111',
            'no_nik' => '1111111111111111',
            'id_syahriyyah' => 1,
            'id_diniyyah' => 1,
            'id_catering' => 1,
            'status' => 'Aktif',
            'tahun_angkatan' => 2022,
            'password' => bcrypt('password')
        ]);

        Livewire::test(SantriEdit::class)
            ->call('edit', $this->santri->id)
            ->set('nis', '111111111111111111')  // Try to use other santri's NIS
            ->set('no_hp', '081111111111')      // Try to use other santri's phone
            ->set('no_nik', '1111111111111111') // Try to use other santri's NIK
            ->call('update')
            ->assertHasErrors([
                'nis' => 'unique',
                'no_hp' => 'unique',
                'no_nik' => 'unique'
            ]);
    }

    /** @test */
    public function validates_format_of_fields()
    {
        Livewire::test(SantriEdit::class)
            ->call('edit', $this->santri->id)
            ->set('jenis_kelamin', 'X')         // Invalid gender
            ->set('nis', '12345')               // Too short NIS
            ->set('no_hp', '123')               // Too short phone
            ->set('no_nik', '123')              // Too short NIK
            ->set('tgl_lahir', 'invalid-date')  // Invalid date
            ->set('tahun_angkatan', 1900)       // Invalid year
            ->call('update')
            ->assertHasErrors([
                'jenis_kelamin' => 'in',
                'nis' => 'digits',
                'no_hp' => 'digits_between',
                'no_nik' => 'digits',
                'tgl_lahir' => 'date',
                'tahun_angkatan' => 'in'
            ]);
    }
}