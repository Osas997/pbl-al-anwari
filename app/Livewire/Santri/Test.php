<?php

namespace App\Livewire\Santri;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Settings')]
#[Layout('layouts.guest')]
class Test extends Component
{

    public function save()
    {
        flash('test', 'info');
        // throw new \Exception('test');
    }

    public function render()
    {
        return view('livewire.santri.test');
    }
}
