<?php

namespace App\Livewire\Admin\Angkatan;

use App\Models\Angkatan;
use Livewire\Attributes\On;
use Livewire\Component;

class AngkatanTable extends Component
{

    #[On("delete-angkatan")]
    public function delete($angkatan_id)
    {
        try {
            $angkatan = Angkatan::findOrFail($angkatan_id);
            $angkatan->delete();
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus Angkatan " . $th->getMessage());
        }
    }

    #[On('toast')]
    public function render()
    {
        $angkatan = Angkatan::latest()->get();
        return view('livewire.admin.angkatan.angkatan-table', compact('angkatan'));
    }
}
