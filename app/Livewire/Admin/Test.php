<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Test')]
class Test extends Component
{
    public function render()
    {
        return view('livewire.admin.test');
    }
}
