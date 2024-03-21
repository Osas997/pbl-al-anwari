<?php

namespace App\Livewire\Admin\Diniyyah;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Diniyyah')]
class Diniyyah extends Component
{
    public function render()
    {
        return view('livewire.admin.diniyyah.diniyyah');
    }
}
