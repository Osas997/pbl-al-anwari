<?php

namespace Tests\Feature\Livewire\Admin\Tagihan;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\Tagihan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Pembayaran;
use App\Models\Syahriyyah;
use App\Events\CreatePembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use App\Livewire\Admin\Tagihan\PembayaranTunai;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PembayaranTunaiTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $tagihan;

    public function setUp(): void
    {
        parent::setUp();

        // Create test data
        Diniyyah::insert([
            ["id" => "1", "nama_tingkatan" => "ULA", "kelas" => "1"]
        ]);

        Catering::insert([
            ["id" => "1", "jumlah_catering" => 1, "biaya" => 100_000]
        ]);

        Syahriyyah::insert([
            ["id" => "1", "jenis_domisili" => "mukim", "biaya" => 100_000]
        ]);

        $santri = Santri::create([
            'id' => null,
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

        $this->tagihan = Tagihan::create([
            'id_santri' => $santri->id,
            'jenis_tagihan' => 'catering',
            'nominal' => 100000,
            'status' => 'belum lunas',
            'tahun_ajaran' => Carbon::now()->year,
            'tgl_tagihan' => Carbon::now()->subDays(1),
            'semester' => null,
            'bulan' => 'Januari'
        ]);

        // $this->tagihan = Tagihan::create([
        //     'jenis_tagihan' => 'catering',
        //     'tahun_ajaran' => Carbon::now()->year,
        //     'semester' => 1,
        //     'bulan' => 'Januari'
        // ]);

        // Create admin user
        $this->admin = Admin::factory()->create();

        // Login as admin
        $this->actingAs($this->admin, 'admin');
    }

    /** @test */
    public function component_can_mount_with_correct_initial_values()
    {
        $tagihanId = $this->tagihan->id;
        $nominal = 1000000;
        $sisaTagihan = 400000;

        $component = Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $tagihanId,
            'nominal' => $nominal,
            'sisaTagihan' => $sisaTagihan
        ]);

        $component->assertSet('tagihanId', $tagihanId)
            ->assertSet('jumlah_bayar', $nominal - $sisaTagihan)
            ->assertSet('nominalTagihan', $nominal)
            ->assertSet('tanggal_bayar', Carbon::now()->format('Y-m-d'));
    }

    /** @test */
    public function validates_required_fields()
    {
        Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $this->tagihan->id,
            'nominal' => 600000,
            'sisaTagihan' => 0
        ])
            ->set('tanggal_bayar', '')
            ->set('jumlah_bayar', '')
            ->call('bayar')
            ->assertHasErrors([
                'tanggal_bayar' => 'required',
                'jumlah_bayar' => 'required',
            ]);
    }

    /** @test */
    public function validates_tanggal_bayar_format()
    {
        Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $this->tagihan->id,
            'nominal' => 600000,
            'sisaTagihan' => 0
        ])
            ->set('tanggal_bayar', 'invalid-date')
            ->call('bayar')
            ->assertHasErrors(['tanggal_bayar' => 'date']);
    }

    /** @test */
    public function validates_jumlah_bayar_is_numeric_and_not_negative()
    {
        Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $this->tagihan->id,
            'nominal' => 600000,
            'sisaTagihan' => 0
        ])
            ->set('jumlah_bayar', 'not-a-number')
            ->call('bayar')
            ->assertHasErrors(['jumlah_bayar' => 'numeric'])
            ->set('jumlah_bayar', -100)
            ->call('bayar')
            ->assertHasErrors(['jumlah_bayar' => 'min']);
    }

    /** @test */
    public function can_process_full_payment_successfully()
    {
        Event::fake();

        $component = Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $this->tagihan->id,
            'nominal' => 1000000,
            'sisaTagihan' => 0
        ])
            ->set('jumlah_bayar', 1000000)
            ->set('tanggal_bayar', Carbon::now()->format('Y-m-d'))
            ->call('bayar');

        // Assert payment was created
        $this->assertDatabaseHas('pembayaran', [
            'id_tagihan' => $this->tagihan->id,
            'id_admin' => $this->admin->id,
            'metode_pembayaran' => 'tunai',
            'jumlah_bayar' => 1000000,
            'status' => 'dikonfirmasi'
        ]);

        // Assert tagihan status was updated to lunas
        $this->assertDatabaseHas('tagihan', [
            'id' => $this->tagihan->id,
            'status' => 'lunas'
        ]);

        // Assert event was dispatched
        Event::assertDispatched(CreatePembayaran::class);

        // Assert component state
        $component->assertSet('tanggal_bayar', '')
            ->assertSet('jumlah_bayar', '')
            ->assertDispatched('pembayaran-tunai');
    }

    /** @test */
    public function can_process_partial_payment_successfully()
    {
        Event::fake();

        $component = Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $this->tagihan->id,
            'nominal' => 1000000,
            'sisaTagihan' => 600000
        ])
            ->set('jumlah_bayar', 400000)
            ->set('tanggal_bayar', Carbon::now()->format('Y-m-d'))
            ->call('bayar');

        // Assert payment was created
        $this->assertDatabaseHas('pembayaran', [
            'id_tagihan' => $this->tagihan->id,
            'id_admin' => $this->admin->id,
            'metode_pembayaran' => 'tunai',
            'jumlah_bayar' => 400000,
            'status' => 'dikonfirmasi'
        ]);

        // Assert tagihan status was updated to angsur
        $this->assertDatabaseHas('tagihan', [
            'id' => $this->tagihan->id,
            'status' => 'angsur'
        ]);

        Event::assertDispatched(CreatePembayaran::class);
    }

    /** @test */
    public function handles_payment_processing_error()
    {
        // Create a scenario where tagihan doesn't exist
        $nonExistentTagihanId = 9999;

        $component = Livewire::test(PembayaranTunai::class, [
            'tagihanId' => $nonExistentTagihanId,
            'nominal' => 1000000,
            'sisaTagihan' => 0
        ])
            ->set('jumlah_bayar', 1000000)
            ->set('tanggal_bayar', Carbon::now()->format('Y-m-d'))
            ->call('bayar');

        // Assert no payment was created due to rollback
        $this->assertDatabaseMissing('pembayaran', [
            'id_tagihan' => $nonExistentTagihanId
        ]);
    }
}