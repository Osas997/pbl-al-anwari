<?php

namespace App\Livewire\Admin\Diniyyah;

use App\Models\Diniyyah;
use Livewire\Attributes\On;
use Livewire\Component;

class DinyyahTable extends Component
{
    #[On("delete-diniyyah")]
    public function delete($diniyyah_id)
    {
        try {
            $diniyyah = Diniyyah::findOrFail($diniyyah_id);
            $diniyyah->delete();
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus Diniyyah " . $th->getMessage());
        }
    }

    #[On('toast')]
    public function render()
    {
        $diniyyah = Diniyyah::latest()->get();
        return view('livewire.admin.diniyyah.dinyyah-table', compact('diniyyah'));
    }
}
