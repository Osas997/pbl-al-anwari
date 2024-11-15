<?php

namespace Tests\Feature\Livewire\Admin\Santri;

use Tests\TestCase;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Syahriyyah;
use App\Livewire\Admin\Santri\SantriDeletedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SantriDeletedFileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_deleted_santri_with_soft_delete()
    {
        $santri = $this->createSantri();

        $santri->delete();

        $this->assertSoftDeleted($santri);
    }

    public function it_can_restore_deleted_santri()
    {
        $santri = $this->createSantri();

        $santri->delete();

        $this->assertSoftDeleted($santri);

        // Lakukan test untuk memulihkan data
        Livewire::test(SantriDeletedFile::class)
            ->call('restore', $santri->id)
            ->assertDispatched('toast', 'Berhasil Restore Data Santri');

        // Pastikan data dipulihkan dari trash
        $this->assertDatabaseHas('santri', [
            'id' => $santri->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_permanently_delete_santri()
    {
        $santri = $this->createSantri();

        $santri->delete();

        $this->assertSoftDeleted($santri);

        // Lakukan test untuk force delete data
        Livewire::test(SantriDeletedFile::class)
            ->call('forceDelete', $santri->id);

        // Pastikan data terhapus permanen dari database
        $this->assertDatabaseMissing('santri', [
            'id' => $santri->id,
        ]);
    }

    public function createSantri()
    {
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

        $santri = Santri::create([
            'nama_santri' => 'Ahmad Rizki',
            'nis' => '351016040604000808',
            'password' => bcrypt('password'),
            'no_nik' => '9876543210123456',
            'no_hp' => '08123456789',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '2005-06-15',
            'alamat' => 'Jl. Raya No. 123, Bandung',
            'nama_ayah' => 'Budi Santoso',
            'nama_ibu' => 'Siti Aminah',
            'status' => 'Aktif',
            'id_syahriyyah' => 1,
            'id_catering' => 1,
            'tahun_angkatan' => 2022,
            'id_diniyyah' => 1,
        ]);

        return $santri;
    }
}