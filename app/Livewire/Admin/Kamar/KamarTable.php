<?php

namespace App\Livewire\Admin\Kamar;

use App\Models\Kamar;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class KamarTable extends Component
{
    use WithPagination;

    #[On('toast')]
    public function render()
    {
        $kamar = Kamar::latest()->paginate(10);

        return view('livewire.admin.kamar.kamar-table', compact('kamar'));
    }
}
