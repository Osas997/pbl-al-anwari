<?php

namespace Tests\Feature\Livewire\Admin\Tagihan;

use Tests\TestCase;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\Tagihan;
use App\Livewire\Santri\Pembayaran\RiwayatPembayaranTable;
use App\Models\Admin;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RiwayatPembayaranTest extends TestCase
{
  use RefreshDatabase;

  protected $santri;
  protected $tagihan;
  protected $pembayaran;

  public function setUp(): void
  {
    parent::setUp();

    $this->santri = $this->createSantri([
      'nama_santri' => 'Budi'
    ]);

    $this->tagihan = $this->createTagihanForSantri($this->santri);

    $this->pembayaran = $this->createPembayaranForSantri($this->tagihan);
  }

  public function test_santri_can_see_riwayat_pembayaran_table()
  {
    Livewire::test(RiwayatPembayaranTable::class)
      ->assertViewIs('livewire.santri.pembayaran.riwayat-pembayaran-table')
      ->assertStatus(200);
  }

  public function test_unauthorized_user_cannot_see_riwayat_pembayaran_table()
  {
    $response = $this->get(route('riwayat-pembayaran-santri'));

    $response->assertRedirect(route('login'));
  }

  public function test_verify_field_pembayaran_is_valid()
  {
    Livewire::test(RiwayatPembayaranTable::class)
      ->assertSee($this->pembayaran->tagihan->jenis_tagihan)
      ->assertSee($this->pembayaran->tagihan->semester ?? '-')
      ->assertSee($this->pembayaran->tagihan->bulan ?? '-')
      ->assertSee($this->pembayaran->tagihan->tahun_ajaran)
      ->assertSee($this->pembayaran->tagihan->formatToRupiah('nominal'))
      ->assertSee(ucwords($this->pembayaran->tagihan->status));
  }

  public function test_failed_table_pembayaran_is_empty()
  {
    $this->pembayaran->delete();
    Livewire::test(RiwayatPembayaranTable::class)
      ->assertDontSee($this->pembayaran->tagihan->santri->nama_santri)
      ->assertDontSee($this->pembayaran->tagihan->jenis_tagihan)
      ->assertDontSee($this->pembayaran->metode_pembayaran)
      ->assertDontSee($this->pembayaran->status)
      ->assertDontSee($this->pembayaran->tagihan->tgl_tagihan->translatedFormat('d F Y'))
      ->assertSee('Tidak Ada Data Pembayaran');
  }

  protected function createSantri(array $attributes = [])
  {
    return Santri::factory()->create($attributes);
  }

  protected function createTagihanForSantri($santri, array $attributes = [])
  {
    return Tagihan::create(array_merge([
      'id_santri' => $santri->id,
      'jenis_tagihan' => 'syahriyyah',
      'nominal' => 100000,
      'status' => 'belum lunas',
      'tahun_ajaran' => now()->year,
      'tgl_tagihan' => now()->subDays(1),
      'semester' => 1,
    ], $attributes));
  }

  protected function createPembayaranForSantri($tagihan, array $attributes = [])
  {
    $admin = Admin::factory()->create();
    return Pembayaran::create(array_merge([
      "id_tagihan" => $this->tagihan->id,
      "metode_pembayaran" => "transfer",
      "jumlah_bayar" => 100000,
      "tanggal_bayar" => date('Y-m-d'),
      "status" => "pending"
    ]), $attributes);
  }
}