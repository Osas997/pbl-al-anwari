<?php

namespace App\Livewire\Admin\Kamar;

use App\Models\Kamar;
use Livewire\Attributes\On;
use Livewire\Component;

class KamarDeletedFile extends Component
{

    public function restore($kamar_id)
    {
        $kamar = Kamar::onlyTrashed()->findOrFail($kamar_id);
        $kamar->restore();
        $this->dispatch('toast', 'Kamar Berhasil Kembali');
    }

    #[On('force-delete-kamar')]
    public function forceDelete($kamar_id)
    {
        $kamar = Kamar::onlyTrashed()->findOrFail($kamar_id);
        $kamar->forceDelete();
        $this->dispatch('toast', 'Kamar Terhapus Permanent');
    }

    public function render()
    {
        $kamar = Kamar::onlyTrashed()->get();

        return view('livewire.admin.kamar.kamar-deleted-file', compact('kamar'));
    }
}
