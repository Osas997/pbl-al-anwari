<?php

namespace Tests\Feature\Livewire\Admin\Santri;

use App\Livewire\Admin\Santri\SantriCreate;
use App\Livewire\Admin\Santri\SantriDeletedFile;
use App\Livewire\Admin\Santri\SantriEdit;
use App\Livewire\Admin\Santri\SantriDetail;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Santri;
use App\Models\Syahriyyah;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CRUDSantriTest extends TestCase
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
    public function can_render_create_santri_component()
    {
        Livewire::test(SantriCreate::class)
            ->assertViewIs('livewire.admin.santri.santri-create');
    }

    /** @test */
    public function can_create_new_santri()
    {
        Livewire::test(SantriCreate::class)
            ->set('nama_santri', 'Elang Prakoso')
            ->set('nama_ayah', 'Irpan Ali')
            ->set('nama_ibu', 'Khomisah')
            ->set('tempat_lahir', 'Banyuwangi')
            ->set('tgl_lahir', '2004-06-04')
            ->set('alamat', 'Banyuwangi')
            ->set('jenis_kelamin', 'L')
            ->set('nis', '123456789012345679')
            ->set('no_hp', '081933301405')
            ->set('no_nik', '1234667890123456')
            ->set('id_syahriyyah', 1)
            ->set('id_diniyyah', 1)
            ->set('id_catering', 1)
            ->set('tahun_angkatan', 2022)
            ->call('store')
            ->assertDispatched('santri')
            ->assertDispatched('close-modal', 'create-santri-modal');

        $this->assertTrue(Santri::where('nama_santri', 'Elang Prakoso')->where('nis', '123456789012345679')->exists());
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
    public function it_can_deleted_santri_with_soft_delete()
    {
        $santri = $this->santri;

        $santri->delete();

        $this->assertSoftDeleted($santri);
    }

    public function it_can_restore_deleted_santri()
    {
        $santri = $this->santri;

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
        $santri = $this->santri;

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

}