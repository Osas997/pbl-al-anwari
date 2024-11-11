<?php

namespace Tests\Unit;

use App\Livewire\Admin\Tagihan\PembayaranTunai;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PembayaranTunaiTest extends TestCase
{
    use RefreshDatabase;

    protected $tagihan;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        // $this->admin = Admin::factory()->create();
        
        // Create a tagihan
        // $this->tagihan = Tagihan::factory()->create([
        //     'status' => 'belum_lunas',
        //     'nominal' => 1000000
        // ]);

        // // Login as admin
        // $this->actingAs($this->admin, 'admin');
    }


    public function test_component_render_successfully()
    {
        $nominal = 1000000;
        $sisaTagihan = 400000;

        Livewire::test(PembayaranTunai::class, [
            'tagihanId' => 1,
            'nominal' => $nominal,
            'sisaTagihan' => $sisaTagihan
        ])
        ->assertStatus(200);
    }
}