<?php

namespace App\Livewire\Admin\Kamar;

use App\Models\Kamar;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KamarEdit extends Component
{
    #[Validate('required', message: "Ketua Kamar Tidak Boleh Kosong")]
    public $ketua_kamar;

    #[Validate('required', message: "Nama Kamar Tidak Boleh Kosong")]
    public $nama_kamar;

    public $kamar_id;

    #[On('update-kamar')]
    public function edit($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);
        $this->kamar_id = $kamar->id;
        $this->ketua_kamar = $kamar->ketua_kamar;
        $this->nama_kamar = $kamar->nama_kamar;
        $this->dispatch('open-modal', 'edit-kamar-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        try {
            Kamar::find($this->kamar_id)->update($validate);

            $this->reset();

            $this->dispatch('toast', 'Berhasil Ubah Kamar');

            $this->dispatch('close-modal', 'edit-kamar-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Ubah Kamar " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.kamar.kamar-edit');
    }
}
