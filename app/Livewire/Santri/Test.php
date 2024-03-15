<?php

namespace App\Livewire\Santri;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Settings')]
class Test extends Component
{
    public function render()
    {
        return view('livewire.santri.test');
    }
}
