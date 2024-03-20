<?php

namespace App\Livewire\Admin\Diniyyah;

use App\Models\Diniyyah;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DinyyahCreate extends Component
{

    #[Validate('required', message: "Nama Angkatan Tidak Boleh Kosong")]
    public $nama_tingkatan;

    #[Validate('required', message: "Kelas Tidak Boleh Kosong")]
    public $kelas;

    public function store()
    {
        $validate = $this->validate();

        try {
            Diniyyah::create($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Menambah Diniyyah');

            $this->dispatch('close-modal', 'create-diniyyah-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menambah Diniyyah " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.diniyyah.dinyyah-create');
    }
}
