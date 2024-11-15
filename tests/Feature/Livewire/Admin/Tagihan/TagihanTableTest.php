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

    /** @test */
    public function it_lists_tagihan_records()
    {
        $santri = $this->createSantri();
        $this->createTagihanForSantri($santri);

        Livewire::test(TagihanTable::class)
            ->assertSee($santri->nama_santri)
            ->assertSee('belum lunas');
    }

    /** @test */
    public function it_searches_tagihan_by_santri_name()
    {
        $santri = $this->createSantri(['nama_santri' => 'Ahmad Rizki']);
        $otherSantri = $this->createSantri(['nama_santri' => 'Budi Santoso']);
        $this->createTagihanForSantri($santri);
        $this->createTagihanForSantri($otherSantri);

        Livewire::test(TagihanTable::class)
            ->set('search', 'Ahmad Rizki')
            ->assertSee('Ahmad Rizki')
            ->assertDontSee('Budi Santoso');
    }

    /** @test */
    public function it_deletes_a_tagihan()
    {
        $santri = $this->createSantri();
        $tagihan = $this->createTagihanForSantri($santri);

        Livewire::test(TagihanTable::class)
            ->call('deleteTagihan', $tagihan)
            ->assertDispatched('toast', "Tagihan berhasil dihapus");

        $this->assertDatabaseMissing('tagihan', ['id' => $tagihan->id]);
    }

    /** @test */
    public function it_shows_error_when_deleting_a_lunas_tagihan()
    {
        $santri = $this->createSantri();
        $tagihan = $this->createTagihanForSantri($santri, ['status' => 'lunas']);

        Livewire::test(TagihanTable::class)
            ->call('deleteTagihan', $tagihan)
            ->assertDispatched('toast', "Gagal Menghapus Tagihan, Tagihan Telah Lunas");

        $this->assertDatabaseHas('tagihan', ['id' => $tagihan->id]);
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
}
