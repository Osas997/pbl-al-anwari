<?php

namespace App\Livewire\Admin\Rekening;

use App\Models\BankPondok;
use Livewire\Attributes\On;
use Livewire\Component;

class RekeningTable extends Component
{

    #[On("delete-rekening")]
    public function delete($rekening_id)
    {
        try {
            $totalRekening = BankPondok::count();
            if ($totalRekening == 1) {
                flash('Gagal Menghapus Rekening. Tidak Bisa Menghapus Rekening Terakhir', 'danger');
                return;
            }

            $rekening = BankPondok::findOrFail($rekening_id);

            $rekening->delete();
            flash('Berhasil Hapus Rekening', 'success');
        } catch (\Throwable $th) {
            flash('Gagal Menghapus Rekening ' . $th->getMessage(), 'danger');
        }
    }

    #[On("create-rekening")]
    #[On("update-rekening")]
    public function render()
    {
        $rekening = BankPondok::latest()->get();
        return view('livewire.admin.rekening.rekening-table', compact('rekening'));
    }
}
