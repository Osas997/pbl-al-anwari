<?php

namespace App\Livewire\Admin\Santri;

use App\Models\Santri;
use Livewire\Attributes\On;
use Livewire\Component;

class SantriDeletedFile extends Component
{
    public function restore($santri_id)
    {
        try {
            $santri = Santri::onlyTrashed()->findOrFail($santri_id);
            $santri->restore();
            $this->dispatch('toast', 'Santri Berhasil Kembali');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Mengembalikan Santri " . $th->getMessage());
        }
    }

    #[On('force-delete-santri')]
    public function forceDelete($santri_id)
    {
        try {
            $santri = Santri::onlyTrashed()->findOrFail($santri_id);
            $santri->forceDelete();
            $this->dispatch('toast', 'Santri Terhapus Permanent');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus Santri " . $th->getMessage());
        }
    }
    public function render()
    {
        $santri = santri::onlyTrashed()->get();
        return view('livewire.admin.santri.santri-deleted-file', compact('santri'));
    }
}
