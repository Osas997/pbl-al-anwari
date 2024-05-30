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
            flash('Berhasil Restore Data Santri', 'success');
        } catch (\Throwable $th) {
            flash("Gagal Mengembalikan Santri " . $th->getMessage(), 'success');
        }
    }

    #[On('force-delete-santri')]
    public function forceDelete($santri_id)
    {
        try {
            $santri = Santri::onlyTrashed()->findOrFail($santri_id);
            $santri->forceDelete();
            flash('Berhasil Hapus Data Santri', 'success');
        } catch (\Throwable $th) {
            flash("Gagal Menghapus Data Santri " . $th->getMessage(), 'success');
        }
    }
    public function render()
    {
        $santri = santri::onlyTrashed()->get();
        return view('livewire.admin.santri.santri-deleted-file', compact('santri'));
    }
}
