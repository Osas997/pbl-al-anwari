<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Santri')]
class Santri extends Component
{

    public function render()
    {

        return view('livewire.admin.santri.santri');
    }
}
