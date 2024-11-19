<?php

namespace Tests\Feature\Livewire\Admin\Laporan;

use App\Livewire\Admin\Laporan\LaporanPembayaran;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Santri;
use App\Models\Tagihan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Pembayaran;
use App\Models\Syahriyyah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class LaporanPembayaranTest extends TestCase
{
  use RefreshDatabase;

  protected $pembayaran;

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

    // Buat tagihan catering
    $tagihanCatering = Tagihan::create([
      'id_santri' => $santri->id,
      'jenis_tagihan' => 'catering',
      'nominal' => 100000,
      'status' => 'belum lunas',
      'tahun_ajaran' => Carbon::now()->year,
      'tgl_tagihan' => Carbon::now()->subDays(1),
      'semester' => null,
      'bulan' => 'Januari'
    ]);

    // Buat tagihan syahriyyah
    $tagihanSyahriyyah = Tagihan::create([
      'id_santri' => $santri->id,
      'jenis_tagihan' => 'syahriyyah',
      'nominal' => 100000,
      'status' => 'belum lunas',
      'tahun_ajaran' => Carbon::now()->year,
      'tgl_tagihan' => Carbon::now()->subDays(1),
      'semester' => 2,
      'bulan' => null
    ]);

    $admin =  Admin::factory()->create();

    // Buat pembayaran catering
    Pembayaran::create([
      'id_tagihan' => $tagihanCatering->id,
      'id_admin' => $admin->id,
      'jumlah_bayar' => 100000,
      'metode_pembayaran' => 'tunai',
      'status' => 'dikonfirmasi',
      'tanggal_bayar' => Carbon::now()
    ]);

    // Buat pembayaran syahriyyah
    Pembayaran::create([
      'id_tagihan' => $tagihanSyahriyyah->id,
      'id_admin' => $admin->id,
      'jumlah_bayar' => 100000,
      'metode_pembayaran' => 'tunai',
      'status' => 'dikonfirmasi',
      'tanggal_bayar' => Carbon::now()
    ]);

    // Create admin user

    // Login as admin
    $this->actingAs($admin, 'admin');
  }

  public function test_laporan_pembayaran_component_render_successfully()
  {
    Livewire::test(LaporanPembayaran::class)
      ->assertViewIs('livewire.admin.laporan.laporan-pembayaran');
  }

  public function test_cetak_pembayaran_syahriyyah_successfully()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('jenis_tagihan', 'syahriyyah')
      ->set('tahun_ajaran', Carbon::now()->year)
      ->set('semester', 2)
      ->call('cetakPdf')
      ->assertStatus(200);
  }

  public function test_cetak_pembayaran_catering_successfully()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('jenis_tagihan', 'catering')
      ->set('tahun_ajaran', Carbon::now()->year)
      ->set('bulan', 'Januari')
      ->call('cetakPdf')
      ->assertStatus(200);
  }

  public function test_validation_semester_for_pembayaran_syahriyyah()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('jenis_tagihan', 'syahriyyah')
      ->set('tahun_ajaran', Carbon::now()->year)
      ->set('semester', null)
      ->call('cetakPdf')
      ->assertHasErrors(['semester']);
  }

  public function test_validation_bulan_for_pembayaran_catering()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('jenis_tagihan', 'catering')
      ->set('tahun_ajaran', Carbon::now()->year)
      ->set('bulan', null)
      ->call('cetakPdf')
      ->assertHasErrors(['bulan']);
  }

  public function test_validation_tahun_ajaran_required()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('tahun_ajaran', null)
      ->call('cetakPdf')
      ->assertHasErrors(['tahun_ajaran' => 'Tahun Ajaran Tidak Boleh Kosong']);
  }

  public function test_validation_tahun_ajaran_invalid()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('tahun_ajaran', 2000)
      ->call('cetakPdf')
      ->assertHasErrors(['tahun_ajaran' => 'Tahun Ajaran Tidak Valid']);
  }

  public function test_cetak_laporan_failed_with_not_found_data()
  {
    Livewire::test(LaporanPembayaran::class)
      ->set('jenis_tagihan', 'catering')
      ->set('tahun_ajaran', Carbon::now()->year)
      ->set('bulan', 'Februari')
      ->call('cetakPdf')
      ->assertSet('errorMessage', 'Hasil Laporan Pembayaran Tidak Ditemukan');
  }
}
