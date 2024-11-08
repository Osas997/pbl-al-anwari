<?php

namespace Tests\Unit;

use App\Models\Diniyyah;
use Livewire\Livewire;
use App\Livewire\Admin\Diniyyah\DinyyahCreate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiniyyahCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_dapat_menambah_diniyyah_dengan_input_valid()
    {
        Livewire::test('admin.diniyyah.dinyyah-create')
            ->set('nama_tingkatan', 'ULA')
            ->set('kelas', '1')
            ->call('store')
            ->assertDispatched('toast', 'Berhasil Menambah Diniyyah');

        $this->assertTrue(Diniyyah::where('nama_tingkatan', 'ULA')->where('kelas', '1')->exists());
    }

    /** @test */
    public function admin_gagal_menambah_diniyyah_dengan_nama_kosong()
    {
        Livewire::test('admin.diniyyah.dinyyah-create')
            ->set('nama_tingkatan', '')
            ->set('kelas', '1')
            ->call('store')
            ->assertHasErrors(['nama_tingkatan' => 'required']);
    }

    /** @test */
    public function admin_gagal_menambah_diniyyah_dengan_kelas_kosong()
    {
        Livewire::test('admin.diniyyah.dinyyah-create')
            ->set('nama_tingkatan', 'ULA')
            ->set('kelas', '')
            ->call('store')
            ->assertHasErrors(['kelas' => 'required']);
    }
}