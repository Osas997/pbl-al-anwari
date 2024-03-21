<?php

namespace App\Livewire\Admin\Angkatan;

use App\Models\Angkatan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AngkatanCreate extends Component
{
    #[Validate('required', message: "Tahun Angkatan Tidak Boleh Kosong")]
    public $tahun_angkatan;

    public function store()
    {
        $validate = $this->validate();

        try {
            Angkatan::create($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Menambah Angkatan');

            $this->dispatch('close-modal', 'create-angkatan-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menambah Angkatan " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.angkatan.angkatan-create');
    }
}
