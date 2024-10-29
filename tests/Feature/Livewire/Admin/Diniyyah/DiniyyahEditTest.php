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
        // Simulasi data Diniyyah yang ada
        $diniyyah = Diniyyah::create([
            'nama_tingkatan' => 'Angkatan Lama',
            'kelas' => 'Kelas Lama',
        ]);

        // Simulasi data baru untuk update
        $newData = [
            'nama_tingkatan' => 'Angkatan Baru',
            'kelas' => 'Kelas Baru',
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
    public function it_validates_required_fields_when_updating()
    {
        // Simulasi data Diniyyah yang ada
        $diniyyah = Diniyyah::create([
            'nama_tingkatan' => 'Angkatan Lama',
            'kelas' => 'Kelas Lama',
        ]);

        // Lakukan test validasi dengan field kosong
        Livewire::test(DinyyahEdit::class)
            ->call('edit', $diniyyah->id)
            ->set('nama_tingkatan', '')
            ->set('kelas', '')
            ->call('update')
            ->assertHasErrors(['nama_tingkatan' => 'required'])
            ->assertHasErrors(['kelas' => 'required']);
    }
}