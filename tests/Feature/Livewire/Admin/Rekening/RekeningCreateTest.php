<?php

namespace Tests\Feature\Livewire\Admin\Rekening;

use App\Livewire\Admin\Rekening\RekeningCreate;
use App\Models\Bank;
use App\Models\BankPondok;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RekeningCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test bank data
        Bank::insert([
            [
                'id' => 1,
                'nama_bank' => 'BCA',
                'sandi_bank' => '014',
            ],
            [
                'id' => 2,
                'nama_bank' => 'Mandiri',
                'sandi_bank' => '008',
            ]
        ]);
    }

    /** @test */
    public function can_render_create_rekening_component()
    {
        Livewire::test(RekeningCreate::class)
            ->assertViewIs('livewire.admin.rekening.rekening-create');
    }

    /** @test */
    public function can_create_new_rekening()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 1)
            ->call('store')
            ->assertDispatched('create-rekening')
            ->assertDispatched('close-modal', 'create-rekening-modal');

        $this->assertDatabaseHas('bank_pondok', [
            'nama_rekening' => 'John Doe',
            'nomor_rekening' => '1234567890',
            'nama_bank' => 'BCA',
            'sandi_bank' => '014'
        ]);
    }

    /** @test */
    public function nama_rekening_is_required()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 1)
            ->call('store')
            ->assertHasErrors(['nama_rekening' => 'required']);
    }

    /** @test */
    public function nomor_rekening_is_required()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('id_bank', 1)
            ->call('store')
            ->assertHasErrors(['nomor_rekening' => 'required']);
    }

    /** @test */
    public function bank_id_is_required()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->call('store')
            ->assertHasErrors(['id_bank' => 'required']);
    }

    /** @test */
    public function bank_id_must_exist()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 999) // Non-existent bank ID
            ->call('store')
            ->assertHasErrors(['id_bank' => 'exists']);
    }

    /** @test */
    public function fields_are_reset_after_successful_creation()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 1)
            ->call('store')
            ->assertSet('nama_rekening', null)
            ->assertSet('nomor_rekening', null)
            ->assertSet('id_bank', null);
    }

    /** @test */
    public function can_handle_database_error_gracefully()
    {
        // Simulate a database error by using an invalid bank ID after validation
        $component = Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 1);

        // Delete the bank to cause a failure
        Bank::where('id', 1)->delete();

        $component->call('store');

        $this->assertDatabaseMissing('bank_pondok', [
            'nama_rekening' => 'John Doe',
            'nomor_rekening' => '1234567890'
        ]);
    }
}