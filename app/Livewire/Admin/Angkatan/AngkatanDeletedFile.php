<?php

namespace App\Livewire\Admin\Angkatan;

use App\Models\Angkatan;
use Livewire\Attributes\On;
use Livewire\Component;

class AngkatanDeletedFile extends Component
{

    public function restore($angkatan_id)
    {
        try {
            $angkatan = Angkatan::onlyTrashed()->findOrFail($angkatan_id);
            $angkatan->restore();
            $this->dispatch('toast', 'Angkatan Berhasil Kembali');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Mengembalikan Angkatan " . $th->getMessage());
        }
    }

    #[On('force-delete-angkatan')]
    public function forceDelete($angkatan_id)
    {
        try {
            $angkatan = Angkatan::onlyTrashed()->findOrFail($angkatan_id);
            $angkatan->forceDelete();
            $this->dispatch('toast', 'Angkatan Terhapus Permanent');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus Permanent Angkatan " . $th->getMessage());
        }
    }

    public function render()
    {
        $angkatan = Angkatan::onlyTrashed()->get();
        return view('livewire.admin.angkatan.angkatan-deleted-file', compact('angkatan'));
    }
}
