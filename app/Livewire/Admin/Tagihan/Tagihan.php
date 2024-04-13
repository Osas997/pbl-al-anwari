<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Santri;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tagihan Santri')]
class Tagihan extends Component
{
    public function render()
    {
        $totalSantri = Santri::where('status', 'Aktif')->count();

        return view('livewire.admin.tagihan.tagihan', compact('totalSantri'));
    }
}
