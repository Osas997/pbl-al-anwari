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
            $rekening = BankPondok::findOrFail($rekening_id);
            $rekening->delete();
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus rekening " . $th->getMessage());
        }
    }

    #[On("toast")]
    public function render()
    {
        $rekening = BankPondok::latest()->get();
        return view('livewire.admin.rekening.rekening-table', compact('rekening'));
    }
}
