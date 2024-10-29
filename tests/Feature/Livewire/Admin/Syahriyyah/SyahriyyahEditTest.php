<?php

namespace Tests\Unit\Livewire\Admin\Syahriyyah;

use App\Livewire\Admin\Syahriyyah\SyahriyyahEdit;
use App\Models\Syahriyyah;
use Livewire\Livewire;
use Tests\TestCase;

class SyahriyyahEditTest extends TestCase
{
    /** @test */
    public function it_renders_the_syahriyyah_edit_component()
    {
        Livewire::test(SyahriyyahEdit::class)
            ->assertViewIs('livewire.admin.syahriyyah.syahriyyah-edit');
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::test(SyahriyyahEdit::class)
            ->set('jenis_domisili', '')
            ->set('biaya', '')
            ->call('update')
            ->assertHasErrors(['jenis_domisili' => 'required', 'biaya' => 'required']);
    }

    /** @test */
    public function it_validates_numeric_and_minimum_biaya()
    {
        Livewire::test(SyahriyyahEdit::class)
            ->set('jenis_domisili', 'Perumahan')
            ->set('biaya', 'invalid')
            ->call('update')
            ->assertHasErrors(['biaya' => 'numeric']);

        Livewire::test(SyahriyyahEdit::class)
            ->set('jenis_domisili', 'Perumahan')
            ->set('biaya', 0)
            ->call('update')
            ->assertHasErrors(['biaya' => 'min']);
    }

    /** @test */
    public function it_updates_the_syahriyyah_information()
    {
        // Membuat instance Syahriyyah secara manual tanpa factory
        $syahriyyah = Syahriyyah::create([
            'jenis_domisili' => 'Kampung',
            'biaya' => 1000,
        ]);

        Livewire::test(SyahriyyahEdit::class)
            ->call('edit', $syahriyyah->id)
            ->set('jenis_domisili', 'Perumahan')
            ->set('biaya', 2000)
            ->call('update');

        $this->assertDatabaseHas('syahriyyah', [
            'id' => $syahriyyah->id,
            'jenis_domisili' => 'Perumahan',
            'biaya' => 2000,
        ]);
    }

    /** @test */
    public function it_dispatches_success_message_on_update()
    {
        $syahriyyah = Syahriyyah::create([
            'jenis_domisili' => 'Kampung',
            'biaya' => 1000,
        ]);

        Livewire::test(SyahriyyahEdit::class)
            ->call('edit', $syahriyyah->id)
            ->set('jenis_domisili', 'Perumahan')
            ->set('biaya', 2000)
            ->call('update')
            ->assertDispatched('toast', 'Berhasil Ubah Syahriyyah');
    }
}