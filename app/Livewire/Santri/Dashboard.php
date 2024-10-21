<?php

namespace App\Livewire\Santri;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.santri.dashboard');
    }
}