<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Santri\MyProfile;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class MyProfileTest extends TestCase
{
    use RefreshDatabase;

    protected Santri $santri;

    protected function setUp(): void
    {
        parent::setUp();

        $this->santri = $this->createSantri([
          'nama_santri' => 'Budi'
        ]);
    
    
        $this->actingAs($this->santri);
    }

    protected function createSantri(array $attributes = [])
    {
        return Santri::factory()->create($attributes);
    }

    /** @test */
    public function it_mounts_with_user_data()
    {
        Livewire::test(MyProfile::class)
            ->assertSet('nama_santri', 'Budi');
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::test(MyProfile::class)
            ->set('nama_santri', '')
            ->call('edit')
            ->assertHasErrors(['nama_santri' => 'Nama Santri Tidak Boleh Kosong']);

        Livewire::test(MyProfile::class)
            ->set('tempat_lahir', '')
            ->call('edit')
            ->assertHasErrors(['tempat_lahir' => 'Tempat Lahir Tidak Boleh Kosong']);

        Livewire::test(MyProfile::class)
            ->set('tgl_lahir', '')
            ->call('edit')
            ->assertHasErrors(['tgl_lahir' => 'Tanggal Lahir Tidak Boleh Kosong']);

        Livewire::test(MyProfile::class)
            ->set('alamat', '')
            ->call('edit')
            ->assertHasErrors(['alamat' => 'Alamat Tidak Boleh Kosong']);
    }

    /** @test */
    public function it_updates_user_profile()
    {
        Livewire::test(MyProfile::class)
            ->set('nama_santri', 'Budi Edit')
            ->set('no_hp', '08123456780')
            ->set('tempat_lahir', 'Bandung')
            ->set('tgl_lahir', '2000-02-02')
            ->set('alamat', 'Jl. Contoh No. 2')
            ->call('edit')
            ->assertStatus(200);

        $this->santri->refresh();

        $this->assertEquals('Budi Edit', $this->santri->nama_santri);
        $this->assertEquals('08123456780', $this->santri->no_hp);
        $this->assertEquals('Bandung', $this->santri->tempat_lahir);
        $this->assertEquals('2000-02-02', $this->santri->tgl_lahir);
        $this->assertEquals('Jl. Contoh No. 2', $this->santri->alamat);
    }

    /** @test */
    public function it_validates_no_hp_field()
    {
        Livewire::test(MyProfile::class)
            ->set('no_hp', '')
            ->call('edit')
            ->assertHasErrors(['no_hp' => 'Nomor HP tidak boleh kosong.']);

        Livewire::test(MyProfile::class)
            ->set('no_hp', 'abc')
            ->call('edit')
            ->assertHasErrors(['no_hp' => 'Nomor HP harus angka.']);

        Livewire::test(MyProfile::class)
            ->set('no_hp', '123456')
            ->call('edit')
            ->assertHasErrors(['no_hp' => 'No HP Harus 11-13 Digit']);

        Livewire::test(MyProfile::class)
            ->set('no_hp', '23232323323432')
            ->call('edit')
            ->assertHasErrors(['no_hp' => 'No HP Harus 11-13 Digit']);

        $this->createSantri([
            'nama_santri' => 'Rafli',
            'no_hp' => '08123456780'
        ]);
        Livewire::test(MyProfile::class)
            ->set('no_hp', '08123456780')
            ->call('edit')
            ->assertHasErrors(['no_hp' => 'Nomor HP sudah terdaftar.']);
    }


    /** @test */
    public function it_validates_tgl_lahir_field()
    {
        Livewire::test(MyProfile::class)
            ->set('tgl_lahir', 'abc')
            ->call('edit')
            ->assertHasErrors(['tgl_lahir' => 'Tanggal Lahir Tidak Valid']);
    }
} 
