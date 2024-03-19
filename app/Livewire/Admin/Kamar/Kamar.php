<?php

namespace App\Livewire\Admin\Kamar;


use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Kamar')]
class Kamar extends Component
{
    public function render()
    {
        return view('livewire.admin.kamar.kamar');
    }
}
