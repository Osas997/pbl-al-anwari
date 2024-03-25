<?php

namespace App\Livewire\Admin\Syahriyyah;

use App\Models\Syahriyyah;
use Livewire\Attributes\On;
use Livewire\Component;

class SyahriyyahTable extends Component
{
    #[On('toast')]
    public function render()
    {
        $syahriyyah = Syahriyyah::latest()->get();
        return view('livewire.admin.syahriyyah.syahriyyah-table', compact('syahriyyah'));
    }
}
