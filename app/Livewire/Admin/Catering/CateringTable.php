<?php

namespace App\Livewire\Admin\Catering;

use App\Models\Catering;
use Livewire\Attributes\On;
use Livewire\Component;

class CateringTable extends Component
{

    #[On('toast')]
    public function render()
    {
        $catering = Catering::latest()->get();
        return view('livewire.admin.catering.catering-table', compact('catering'));
    }
}
