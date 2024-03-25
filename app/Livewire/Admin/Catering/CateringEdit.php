<?php

namespace App\Livewire\Admin\Catering;

use App\Models\Catering;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CateringEdit extends Component
{

    #[Validate('required', message: "Jumlah Catering Tidak Boleh Kosong")]
    #[Validate('numeric', message: "Jumlah Catering Harus Berupa Angka")]
    #[Validate('min:1', message: "Jumlah Catering Minimal 1 Kali Makan")]
    public $jumlah_catering;

    #[Validate('required', message: "Biaya Catering Tidak Boleh Kosong")]
    #[Validate('numeric', message: "Biaya Catering Harus Berupa Angka")]
    #[Validate('min:1', message: "Biaya Catering Minimal 1 Rupiah")]
    public $biaya;

    public $catering_id;

    #[On('update-catering')]
    public function edit($catering_id)
    {
        $catering = Catering::findOrFail($catering_id);
        $this->catering_id = $catering->id;
        $this->jumlah_catering = $catering->jumlah_catering;
        $this->biaya = $catering->biaya;
        $this->dispatch('open-modal', 'edit-catering-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        try {
            Catering::find($this->catering_id)->update($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Ubah Catering');

            $this->dispatch('close-modal', 'edit-catering-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Ubah Catering " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.catering.catering-edit');
    }
}
