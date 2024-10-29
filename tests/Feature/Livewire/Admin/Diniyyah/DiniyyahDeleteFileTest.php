<?php

namespace Tests\Unit;

use App\Models\Diniyyah;
use Livewire\Livewire;
use App\Livewire\Admin\Diniyyah\DinyyahDeletedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiniyyahDeleteFileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_deleted_diniyyah_with_soft_delete()
    {
        $diniyyah = Diniyyah::create([
            'nama_tingkatan' => 'Angkatan 2024',
            'kelas' => 'Kelas A'
        ]);

        $diniyyah->delete();

        $this->assertSoftDeleted($diniyyah);
    }

    /** @test */
    public function it_can_restore_deleted_diniyyah()
    {
        // Simulasi data Diniyyah yang dihapus
        $diniyyah = Diniyyah::create([
            'nama_tingkatan' => 'Angkatan 2024',
            'kelas' => 'Kelas A'
        ]);
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
        $diniyyah = Diniyyah::create([
            'nama_tingkatan' => 'Angkatan 2024',
            'kelas' => 'Kelas A'
        ]);
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
}