<?php

namespace App\Livewire\Admin\Catering;

use App\Models\Catering;
use Livewire\Component;

class CateringTable extends Component
{
    public function render()
    {
        $catering = Catering::latest()->paginate(7);
        return view('livewire.admin.catering.catering-table', compact('catering'));
    }
}
