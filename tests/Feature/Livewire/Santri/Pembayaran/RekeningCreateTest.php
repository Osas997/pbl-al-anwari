<?php

namespace Tests\Feature\Livewire\Santri\Pembayaran;

use Tests\TestCase;
use App\Models\Bank;
use App\Models\User;
use App\Models\Santri;
use Livewire\Livewire;
use App\Models\BankSantri;
use App\Livewire\Santri\Pembayaran\RekeningCreate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RekeningCreateTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $bank;

    public function setUp(): void
    {
        parent::setUp();

        // Create test user
        $this->user = Santri::factory()->create();

        // Create test bank
        $this->bank = Bank::insert([
            'id' => 1,
            'nama_bank' => 'BCA',
            'sandi_bank' => '014'
        ]);

        $this->actingAs($this->user);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::test(RekeningCreate::class)
            ->call('store')
            ->assertHasErrors([
                'nama_rekening' => 'required',
                'nomor_rekening' => 'required',
                'id_bank' => 'required'
            ]);
    }

    /** @test */
    public function it_validates_bank_exists()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 999) // Non-existent bank ID
            ->call('store')
            ->assertHasErrors(['id_bank' => 'exists']);
    }

    /** @test */
    public function it_validates_unique_nomor_rekening()
    {
        // Create existing bank account
        BankSantri::create([
            'nomor_rekening' => '1234567890'
        ]);

        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890') // Already existing account number
            ->set('id_bank', $this->bank->id)
            ->call('store')
            ->assertHasErrors(['nomor_rekening' => 'unique']);
    }

    /** @test */
    public function it_successfully_creates_rekening()
    {
        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', $this->bank->id)
            ->call('store')
            ->assertHasNoErrors()
            ->assertDispatched('create-rekening')
            ->assertDispatched('toast')
            ->assertDispatched('close-modal');

        // Assert record was created in database
        $this->assertDatabaseHas('bank_santri', [
            'id_santri' => $this->user->id,
            'nama_bank' => $this->bank->nama_bank,
            'sandi_bank' => $this->bank->sandi_bank,
            'nomor_rekening' => '1234567890',
            'nama_rekening' => 'John Doe',
        ]);
    }

    /** @test */
    public function it_resets_fields_after_successful_creation()
    {
        $component = Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 1)
            ->call('store');

        $component
            ->assertSet('nama_rekening', null)
            ->assertSet('nomor_rekening', null)
            ->assertSet('id_bank', null);
    }

    /** @test */
    public function it_handles_errors_during_creation()
    {
        // Mock Bank::findOrFail to throw an exception
        $this->mock(Bank::class, function ($mock) {
            $mock->shouldReceive('findOrFail')
                ->andThrow(new \Exception('Test error'));
        });

        Livewire::test(RekeningCreate::class)
            ->set('nama_rekening', 'John Doe')
            ->set('nomor_rekening', '1234567890')
            ->set('id_bank', 1)
            ->call('store')
            ->assertDispatched('toast');

        // Assert record was not created
        $this->assertDatabaseMissing('bank_santri', [
            'nomor_rekening' => '1234567890'
        ]);
    }

    /** @test */
    public function it_renders_with_bank_data()
    {
        // Create additional banks
        Bank::factory()->count(3)->create();

        $component = Livewire::test(RekeningCreate::class);

        $component->assertViewHas('dataBank');

        // Get the actual data passed to the view
        $dataBank = $component->viewData('dataBank');

        // Assert it's a collection of bank names keyed by ID
        $this->assertEquals(Bank::count(), $dataBank->count());
        $this->assertArrayHasKey($this->bank->id, $dataBank->toArray());
    }
}
