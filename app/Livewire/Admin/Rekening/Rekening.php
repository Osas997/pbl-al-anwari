<?php

namespace App\Livewire\Admin\Rekening;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Data Rekening')]
class Rekening extends Component
{
    public function render()
    {
        return view('livewire.admin.rekening.rekening');
    }
}
