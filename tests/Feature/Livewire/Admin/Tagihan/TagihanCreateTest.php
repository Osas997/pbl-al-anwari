<?php

namespace Tests\Feature\Livewire\Admin\Tagihan;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\Tagihan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Syahriyyah;
use App\Events\GenerateTagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use App\Livewire\Admin\Tagihan\TagihanCreate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagihanCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_syahriyyah_tagihan_successfully()
    {

        $santri = $this->createSantri();

        Livewire::test(TagihanCreate::class)
            ->set('jenis_tagihan', 'syahriyyah')
            ->set('tahun_ajaran', Carbon::now()->year)
            ->set('semester', 1)
            ->call('generate')
            ->assertDispatched('tagihan')
            ->assertDispatched('close-modal', 'create-tagihan-modal');

        $this->assertDatabaseHas('tagihan', [
            'id_santri' => $santri->id,
            'jenis_tagihan' => 'syahriyyah',
            'nominal' => 100000,
            'status' => 'belum lunas',
            'tahun_ajaran' => Carbon::now()->year,
            'semester' => 1,
            'bulan' => null
        ]);
    }

    /** @test */
    public function it_generates_catering_tagihan_successfully()
    {

        $santri = $this->createSantri();

        Livewire::test(TagihanCreate::class)
            ->set('jenis_tagihan', 'catering')
            ->set('tahun_ajaran', Carbon::now()->year)
            ->set('bulan', 'Januari')
            ->call('generate')
            ->assertDispatched('tagihan')
            ->assertDispatched('close-modal', 'create-tagihan-modal');

        $this->assertDatabaseHas('tagihan', [
            'id_santri' => $santri->id,
            'jenis_tagihan' => 'catering',
            'nominal' => 100000,
            'status' => 'belum lunas',
            'tahun_ajaran' => Carbon::now()->year,
            'semester' => null,
            'bulan' => 'Januari'
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::test(TagihanCreate::class)
            ->set('jenis_tagihan', '')
            ->set('tahun_ajaran', '')
            ->call('generate')
            ->assertHasErrors(['jenis_tagihan' => 'required', 'tahun_ajaran' => 'required']);
    }

    /** @test */
    public function it_validates_jenis_tagihan_and_tahun_ajaran_fields()
    {
        Livewire::test(TagihanCreate::class)
            ->set('jenis_tagihan', 'invalid')
            ->set('tahun_ajaran', 2025)  // Assuming current year is less than 2025
            ->call('generate')
            ->assertHasErrors([
                'jenis_tagihan' => 'in',
                'tahun_ajaran' => 'in',
            ]);
    }

    /** @test */
    public function it_validates_semester_for_syahriyyah_tagihan()
    {
        Livewire::test(TagihanCreate::class)
            ->set('jenis_tagihan', 'syahriyyah')
            ->set('tahun_ajaran', Carbon::now()->year)
            ->set('semester', 3)  // Invalid semester
            ->call('generate')
            ->assertHasErrors(['semester' => 'in']);
    }

    /** @test */
    public function it_validates_bulan_for_catering_tagihan()
    {
        Livewire::test(TagihanCreate::class)
            ->set('jenis_tagihan', 'catering')
            ->set('tahun_ajaran', Carbon::now()->year)
            ->set('bulan', 'InvalidMonth')  // Invalid month
            ->call('generate')
            ->assertHasErrors(['bulan' => 'in']);
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