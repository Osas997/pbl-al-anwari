<?php

namespace Tests\Unit;

use App\Models\Diniyyah;
use Livewire\Livewire;
use App\Livewire\Admin\Diniyyah\DinyyahEdit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiniyyahEditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_edit_and_update_diniyyah()
    {
        $diniyyah = $this->createDiniyyah();

        // Simulasi data baru untuk update
        $newData = [
            'nama_tingkatan' => 'Wustho',
            'kelas' => '2',
        ];

        // Lakukan test pada komponen Livewire
        Livewire::test(DinyyahEdit::class)
            ->call('edit', $diniyyah->id)
            ->set('nama_tingkatan', $newData['nama_tingkatan'])
            ->set('kelas', $newData['kelas'])
            ->call('update')
            ->assertDispatched('toast', 'Berhasil Ubah Diniyyah')
            ->assertDispatched('close-modal', 'edit-diniyyah-modal');

        // Verifikasi bahwa data di database telah diperbarui
        $this->assertDatabaseHas('diniyyah', [
            'id' => $diniyyah->id,
            'nama_tingkatan' => $newData['nama_tingkatan'],
            'kelas' => $newData['kelas'],
        ]);
    }

    /** @test */
    public function it_cannot_edit_and_update_diniyyah_when_nama_tingkatan_empty()
    {
        $diniyyah = $this->createDiniyyah();

        // Lakukan test validasi dengan field kosong
        Livewire::test(DinyyahEdit::class)
            ->call('edit', $diniyyah->id)
            ->set('nama_tingkatan', '')
            ->set('kelas', '2')
            ->call('update')
            ->assertHasErrors(['nama_tingkatan' => 'required']);
    }

    /** @test */
    public function it_cannot_edit_and_update_diniyyah_when_kelas_empty()
    {
        $diniyyah = $this->createDiniyyah();

        // Lakukan test validasi dengan field kosong
        Livewire::test(DinyyahEdit::class)
            ->call('edit', $diniyyah->id)
            ->set('nama_tingkatan', 'Wustho')
            ->set('kelas', '')
            ->call('update')
            ->assertHasErrors(['kelas' => 'required']);
    }

    public function createDiniyyah()
    {
        $diniyyah = Diniyyah::create([
            'nama_tingkatan' => 'ULA',
            'kelas' => '1',
        ]);

        return $diniyyah;
    }
}