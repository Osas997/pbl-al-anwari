<?php

namespace Tests\Unit;

use App\Models\Diniyyah;
use Livewire\Livewire;
use App\Livewire\Admin\Diniyyah\DinyyahCreate;
use App\Livewire\Admin\Diniyyah\DinyyahEdit;
use App\Livewire\Admin\Diniyyah\DinyyahDeletedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CRUDDiniyyahTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_render_create_diniyyah_component()
    {
        Livewire::test(DinyyahCreate::class)
            ->assertViewIs('livewire.admin.diniyyah.dinyyah-create');
    }

    /** @test */
    public function can_create_diniyyah()
    {
        Livewire::test(DinyyahCreate::class)
            ->set('nama_tingkatan', 'ULA')
            ->set('kelas', '1')
            ->call('store')
            ->assertDispatched('toast', 'Berhasil Menambah Diniyyah');

        $this->assertTrue(Diniyyah::where('nama_tingkatan', 'ULA')->where('kelas', '1')->exists());
    }

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
    public function it_can_deleted_diniyyah_with_soft_delete()
    {
        $diniyyah = $this->createDiniyyah();

        $diniyyah->delete();

        $this->assertSoftDeleted($diniyyah);
    }

    /** @test */
    public function it_can_restore_deleted_diniyyah()
    {
        // Simulasi data Diniyyah yang dihapus
        $diniyyah = $this->createDiniyyah();
        $diniyyah->delete();

        // Pastikan data berada di trash
        $this->assertSoftDeleted($diniyyah);

        // Lakukan test untuk memulihkan data
        Livewire::test(DinyyahDeletedFile::class)
            ->call('restore', $diniyyah->id)
            ->assertDispatched('toast', 'Diniyyah Berhasil Kembali');

        // Pastikan data dipulihkan dari trash
        $this->assertDatabaseHas('diniyyah', [
            'id' => $diniyyah->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_can_permanently_delete_diniyyah()
    {
        // Simulasi data Diniyyah yang dihapus
        $diniyyah = $this->createDiniyyah();
        $diniyyah->delete();

        // Pastikan data berada di trash
        $this->assertSoftDeleted($diniyyah);

        // Lakukan test untuk force delete data
        Livewire::test(DinyyahDeletedFile::class)
            ->call('forceDelete', $diniyyah->id)
            ->assertDispatched('toast', 'Diniyyah Terhapus Permanent');

        // Pastikan data terhapus permanen dari database
        $this->assertDatabaseMissing('diniyyah', [
            'id' => $diniyyah->id,
        ]);
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