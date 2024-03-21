<?php

namespace App\Livewire\Admin\Diniyyah;

use App\Models\Diniyyah;
use Livewire\Attributes\On;
use Livewire\Component;

class DinyyahDeletedFile extends Component
{
    public function restore($diniyyah_id)
    {
        $diniyyah = Diniyyah::onlyTrashed()->findOrFail($diniyyah_id);
        $diniyyah->restore();
        $this->dispatch('toast', 'Diniyyah Berhasil Kembali');
    }

    #[On('force-delete-diniyyah')]
    public function forceDelete($diniyyah_id)
    {
        $diniyyah = Diniyyah::onlyTrashed()->findOrFail($diniyyah_id);
        $diniyyah->forceDelete();
        $this->dispatch('toast', 'Diniyyah Terhapus Permanent');
    }


    public function render()
    {
        $diniyyah = Diniyyah::onlyTrashed()->get();

        return view('livewire.admin.diniyyah.dinyyah-deleted-file', compact('diniyyah'));
    }
}
