<?php

namespace App\Livewire\Admin\Diniyyah;

use App\Models\Diniyyah;
use Livewire\Attributes\On;
use Livewire\Component;

class DinyyahDeletedFile extends Component
{
    public function restore($diniyyah_id)
    {
        try {
            $diniyyah = Diniyyah::onlyTrashed()->findOrFail($diniyyah_id);
            $diniyyah->restore();
            $this->dispatch('toast', 'Diniyyah Berhasil Kembali');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Mengembalikan Diniyyah " . $th->getMessage());
        }
    }

    #[On('force-delete-diniyyah')]
    public function forceDelete($diniyyah_id)
    {
        try {
            $diniyyah = Diniyyah::onlyTrashed()->findOrFail($diniyyah_id);
            $diniyyah->forceDelete();
            $this->dispatch('toast', 'Diniyyah Terhapus Permanent');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus Permanent Diniyyah " . $th->getMessage());
        }
    }


    public function render()
    {
        $diniyyah = Diniyyah::onlyTrashed()->get();

        return view('livewire.admin.diniyyah.dinyyah-deleted-file', compact('diniyyah'));
    }
}
