<?php

namespace Tests\Feature\Livewire\Admin\Rekening;

use App\Livewire\Admin\Rekening\RekeningCreate;
use App\Livewire\Admin\Rekening\RekeningEdit;
use App\Livewire\Admin\Rekening\RekeningTable;
use App\Models\Bank;
use App\Models\BankPondok;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CRUDBankTest extends TestCase
{
    use RefreshDatabase;

    protected $rekening;

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
        $this->rekening = BankPondok::insert([
            [
                'id' => 2,
                'nama_bank' => 'BCA',
                'sandi_bank' => '014',
                'nomor_rekening' => '1234567770',
                'nama_rekening' => 'Al-Anwari',
            ],
            [
                'id' => 3,
                'nama_bank' => 'BCA',
                'sandi_bank' => '014',
                'nomor_rekening' => '1234567780',
                'nama_rekening' => 'Al-Anwari2',
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
    public function can_edit_existing_rekening()
    {
        Livewire::test(RekeningEdit::class)
            ->set('rekening_id', 2)
            ->set('nama_rekening', 'Dwi Rifan')
            ->set('nomor_rekening', '0907654321')
            ->set('id_bank', 2)
            ->call('update')
            ->assertDispatched('update-rekening')
            ->assertDispatched('close-modal', 'edit-rekening-modal');

        $this->assertDatabaseHas('bank_pondok', [
            'id' => 2,
            'nama_rekening' => 'Dwi Rifan',
            'nomor_rekening' => '0907654321',
            'nama_bank' => 'Mandiri',
            'sandi_bank' => '008'
        ]);
    }

    /** @test */
    public function it_can_deleted_bank()
    {
        // Mengakses rekening yang telah disiapkan di setUp()
        $rekening = $this->rekening;

        // Memastikan rekening ada, lalu melakukan delete
        $this->assertNotNull($rekening);
        $rekening->delete();

        // Verifikasi apakah rekening sudah dihapus
        $this->assertSoftDeleted($rekening);
    }

}