<?php

namespace Tests\Unit\Livewire\Admin\Catering;

use App\Livewire\Admin\Catering\CateringEdit;
use App\Models\Catering;
use Livewire\Livewire;
use Tests\TestCase;

class CateringEditTest extends TestCase
{
    /** @test */
    public function it_renders_the_catering_edit_component()
    {
        Livewire::test(CateringEdit::class)
            ->assertViewIs('livewire.admin.catering.catering-edit');
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::test(CateringEdit::class)
            ->set('jumlah_catering', '')
            ->set('biaya', '')
            ->call('update')
            ->assertHasErrors(['jumlah_catering' => 'required', 'biaya' => 'required']);
    }

    /** @test */
    public function it_updates_the_catering_information()
    {
        // Create a catering record manually
        $catering = Catering::create([
            'jumlah_catering' => 3,
            'biaya' => 5000,
        ]);

        Livewire::test(CateringEdit::class)
            ->call('edit', $catering->id)
            ->set('jumlah_catering', 4)
            ->set('biaya', 6000)
            ->call('update');

        $this->assertDatabaseHas('catering', [
            'id' => $catering->id,
            'jumlah_catering' => 4,
            'biaya' => 6000,
        ]);
    }

    /** @test */
    public function it_dispatches_success_message_on_update()
    {
        // Create a catering record manually
        $catering = Catering::create([
            'jumlah_catering' => 5,
            'biaya' => 10000,
        ]);

        Livewire::test(CateringEdit::class)
            ->call('edit', $catering->id)
            ->set('jumlah_catering', 6)
            ->set('biaya', 12000)
            ->call('update')
            ->assertDispatched('toast', 'Berhasil Ubah Catering');
    }
}