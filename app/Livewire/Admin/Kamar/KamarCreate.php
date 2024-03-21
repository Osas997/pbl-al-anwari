<?php

namespace App\Livewire\Admin\Kamar;

use App\Models\Kamar;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KamarCreate extends Component
{

    #[Validate('required', message: "Ketua Kamar Tidak Boleh Kosong")]
    public $ketua_kamar;

    #[Validate('required', message: "Nama Kamar Tidak Boleh Kosong")]
    public $nama_kamar;

    public function store()
    {
        $validate = $this->validate();

        try {
            Kamar::create($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Menambah Kamar');

            $this->dispatch('close-modal', 'create-kamar-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menambah Kamar " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.kamar.kamar-create');
    }
}
