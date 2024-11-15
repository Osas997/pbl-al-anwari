<?php

namespace Tests\Feature\Livewire\Admin\Rekening;

use App\Livewire\Admin\Rekening\RekeningEdit;
use App\Models\Bank;
use App\Models\BankPondok;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RekeningEditTest extends TestCase
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

        // Create test rekening data
        BankPondok::insert([
            [
                'id' => 1,
                'nama_bank' => 'BCA',
                'sandi_bank' => '014',
                'nomor_rekening' => '1234567890',
                'nama_rekening' => 'John Doe',
            ]
        ]);
    }

    /** @test */
    public function can_edit_existing_rekening()
    {
        Livewire::test(RekeningEdit::class)
            ->set('rekening_id', 1)
            ->set('nama_rekening', 'Jane Doe')
            ->set('nomor_rekening', '0987654321')
            ->set('id_bank', 2)
            ->call('update')
            ->assertDispatched('update-rekening')
            ->assertDispatched('close-modal', 'edit-rekening-modal');

        $this->assertDatabaseHas('bank_pondok', [
            'id' => 1,
            'nama_rekening' => 'Jane Doe',
            'nomor_rekening' => '0987654321',
            'nama_bank' => 'Mandiri',
            'sandi_bank' => '008'
        ]);
    }
}