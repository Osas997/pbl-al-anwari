<?php

namespace App\Livewire\Admin\Diniyyah;

use App\Models\Diniyyah;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DinyyahEdit extends Component
{

    #[Validate('required', message: "Nama Angkatan Tidak Boleh Kosong")]
    public $nama_tingkatan;

    #[Validate('required', message: "Kelas Tidak Boleh Kosong")]
    public $kelas;

    public $diniyyah_id;

    #[On('update-diniyyah')]
    public function edit($diniyyah_id)
    {
        $diniyyah = Diniyyah::findOrFail($diniyyah_id);
        $this->diniyyah_id = $diniyyah->id;
        $this->nama_tingkatan = $diniyyah->nama_tingkatan;
        $this->kelas = $diniyyah->kelas;
        $this->dispatch('open-modal', 'edit-diniyyah-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        try {
            Diniyyah::find($this->diniyyah_id)->update($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Ubah Diniyyah');

            $this->dispatch('close-modal', 'edit-diniyyah-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Ubah diniyyah " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.diniyyah.dinyyah-edit');
    }
}
