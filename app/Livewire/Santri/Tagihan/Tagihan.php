<?php

namespace App\Livewire\Santri\Tagihan;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tagihan Santri')]
class Tagihan extends Component
{
    public function render()
    {
        return view('livewire.santri.tagihan.tagihan');
    }
}