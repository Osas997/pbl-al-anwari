<?php

namespace Tests\Feature\Livewire\Admin\Tagihan;

use App\Livewire\Admin\Pembayaran\PembayaranTable;
use Tests\TestCase;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\Tagihan;
use App\Livewire\Admin\Tagihan\TagihanTable;
use App\Models\Admin;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PembayaranTableTest extends TestCase
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

  public function test_admin_can_see_pembayaran_table()
  {
    Livewire::test(PembayaranTable::class)
      ->assertViewIs('livewire.admin.pembayaran.pembayaran-table')
      ->assertStatus(200);
  }

  public function test_unauthorized_user_cannot_see_tagihan_table()
  {
    $response = $this->get(route('pembayaran'));

    $response->assertRedirect(route('login'));
  }

  public function test_verify_field_pembayaran_is_valid()
  {
    Livewire::test(PembayaranTable::class)
      ->assertSee($this->pembayaran->tagihan->santri->nama_santri)
      ->assertSee($this->pembayaran->tagihan->jenis_tagihan)
      ->assertSee($this->pembayaran->metode_pembayaran)
      ->assertSee($this->pembayaran->status)
      ->assertSee($this->pembayaran->tagihan->tgl_tagihan->translatedFormat('d F Y'));
  }

  public function test_verify_admin_can_search_tagihan()
  {
    Livewire::test(TagihanTable::class)
      ->set('search', 'Budi')
      ->assertSee('Budi')
      ->assertDontSee('Elang');
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
