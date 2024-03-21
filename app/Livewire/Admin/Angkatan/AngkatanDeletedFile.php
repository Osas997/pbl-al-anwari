<?php

namespace App\Livewire\Admin\Angkatan;

use App\Models\Angkatan;
use Livewire\Attributes\On;
use Livewire\Component;

class AngkatanDeletedFile extends Component
{

    public function restore($angkatan_id)
    {
        $angkatan = Angkatan::onlyTrashed()->findOrFail($angkatan_id);
        $angkatan->restore();
        $this->dispatch('toast', 'Angkatan Berhasil Kembali');
    }

    #[On('force-delete-angkatan')]
    public function forceDelete($angkatan_id)
    {
        $angkatan = Angkatan::onlyTrashed()->findOrFail($angkatan_id);
        $angkatan->forceDelete();
        $this->dispatch('toast', 'Angkatan Terhapus Permanent');
    }

    public function render()
    {
        $angkatan = Angkatan::onlyTrashed()->get();
        return view('livewire.admin.angkatan.angkatan-deleted-file', compact('angkatan'));
    }
}
