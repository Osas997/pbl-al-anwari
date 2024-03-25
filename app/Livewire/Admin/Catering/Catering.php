<?php

namespace App\Livewire\Admin\Catering;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Catering')]
class Catering extends Component
{
    public function render()
    {
        return view('livewire.admin.catering.catering');
    }
}
