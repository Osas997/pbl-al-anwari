<?php

namespace App\Livewire\Admin\Syahriyyah;

use App\Models\Syahriyyah;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SyahriyyahEdit extends Component
{

    #[Validate('required', message: "Jenis Domisili Tidak Boleh Kosong")]
    public $jenis_domisili;

    #[Validate('required', message: "Biaya Syahriyyah Tidak Boleh Kosong")]
    #[Validate('numeric', message: "Biaya Syahriyyah Harus Berupa Angka")]
    #[Validate('min:1', message: "Biaya Syahriyyah Minimal 1 Rupiah")]
    public $biaya;

    public $syahriyyah_id;

    #[On('update-syahriyyah')]
    public function edit($syahriyyah_id)
    {
        $syahriyyah = Syahriyyah::findOrFail($syahriyyah_id);
        $this->syahriyyah_id = $syahriyyah->id;
        $this->jenis_domisili = $syahriyyah->jenis_domisili;
        $this->biaya = $syahriyyah->biaya;
        $this->dispatch('open-modal', 'edit-syahriyyah-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        try {
            Syahriyyah::find($this->syahriyyah_id)->update($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Ubah Syahriyyah');

            $this->dispatch('close-modal', 'edit-syahriyyah-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Ubah Syahriyyah " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.syahriyyah.syahriyyah-edit');
    }
}
