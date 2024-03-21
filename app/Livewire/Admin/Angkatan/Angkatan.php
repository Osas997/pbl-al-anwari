<?php

namespace App\Livewire\Admin\Angkatan;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Angkatan')]
class Angkatan extends Component
{
    public function render()
    {
        return view('livewire.admin.angkatan.angkatan');
    }
}
