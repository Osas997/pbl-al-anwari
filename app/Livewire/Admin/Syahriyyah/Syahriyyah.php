<?php

namespace App\Livewire\Admin\Syahriyyah;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Syahriyyah')]
class Syahriyyah extends Component
{
    public function render()
    {
        return view('livewire.admin.syahriyyah.syahriyyah');
    }
}
