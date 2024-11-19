<?php

namespace Tests\Feature\Livewire\Admin\Tagihan;

use Tests\TestCase;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\Tagihan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Syahriyyah;
use App\Livewire\Admin\Tagihan\TagihanTable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagihanTableTest extends TestCase
{
    use RefreshDatabase;

    protected $santri;
    protected $tagihan;

    public function setUp(): void
    {
        parent::setUp();

        $this->santri = $this->createSantri([
            'nama_santri' => 'Budi'
        ]);

        $this->tagihan = $this->createTagihanForSantri($this->santri);
    }

    public function test_admin_can_see_tagihan_table()
    {
        Livewire::test(TagihanTable::class)
            ->assertViewIs('livewire.admin.tagihan.tagihan-table')
            ->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_see_tagihan_table()
    {
        $response = $this->get(route('tagihan'));

        $response->assertRedirect(route('login'));
    }

    public function test_verify_field_tagihan_is_valid()
    {
        Livewire::test(TagihanTable::class)
            ->assertSee($this->tagihan->santri->nama_santri)
            ->assertSee($this->tagihan->jenis_tagihan)
            ->assertSee($this->tagihan->formatToRupiah('nominal'))
            ->assertSee($this->tagihan->status)
            ->assertSee($this->tagihan->tgl_tagihan->translatedFormat('d F Y'));
    }

    public function test_verify_admin_can_search_tagihan()
    {
        Livewire::test(TagihanTable::class)
            ->set('search', 'Budi')
            ->assertSee('Budi')
            ->assertDontSee('Elang');
    }

    /** @test */
    // public function it_deletes_a_tagihan()
    // {
    //     $santri = $this->createSantri();
    //     $tagihan = $this->createTagihanForSantri($santri);

    //     Livewire::test(TagihanTable::class)
    //         ->call('deleteTagihan', $tagihan)
    //         ->assertDispatched('toast', "Tagihan berhasil dihapus");

    //     $this->assertDatabaseMissing('tagihan', ['id' => $tagihan->id]);
    // }

    // /** @test */
    // public function it_shows_error_when_deleting_a_lunas_tagihan()
    // {
    //     $santri = $this->createSantri();
    //     $tagihan = $this->createTagihanForSantri($santri, ['status' => 'lunas']);

    //     Livewire::test(TagihanTable::class)
    //         ->call('deleteTagihan', $tagihan)
    //         ->assertDispatched('toast', "Gagal Menghapus Tagihan, Tagihan Telah Lunas");

    //     $this->assertDatabaseHas('tagihan', ['id' => $tagihan->id]);
    // }

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
}
