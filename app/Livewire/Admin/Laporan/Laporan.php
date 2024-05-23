<?php

namespace App\Livewire\Admin\Laporan;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Form Laporan')]
class Laporan extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan.laporan');
    }
}
