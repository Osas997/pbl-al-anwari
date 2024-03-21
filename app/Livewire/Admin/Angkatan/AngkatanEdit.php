<?php

namespace App\Livewire\Admin\Angkatan;

use App\Models\Angkatan;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AngkatanEdit extends Component
{

    #[Validate('required', message: "Tahun Angkatan Tidak Boleh Kosong")]
    public $tahun_angkatan;

    public $angkatan_id;

    #[On('update-angkatan')]
    public function edit($angkatan_id)
    {
        $angkatan = Angkatan::findOrFail($angkatan_id);
        $this->angkatan_id = $angkatan->id;
        $this->tahun_angkatan = $angkatan->tahun_angkatan;
        $this->dispatch('open-modal', 'edit-angkatan-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        try {
            Angkatan::find($this->angkatan_id)->update($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Ubah Angkatan');

            $this->dispatch('close-modal', 'edit-angkatan-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Ubah Angkatan " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.angkatan.angkatan-edit');
    }
}
