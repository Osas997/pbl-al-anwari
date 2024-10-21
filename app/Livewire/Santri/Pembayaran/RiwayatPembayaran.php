<?php

namespace App\Livewire\Santri\Pembayaran;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Riwayat Pembayaran')]
class RiwayatPembayaran extends Component
{
    public function render()
    {
        return view('livewire.santri.pembayaran.riwayat-pembayaran');
    }
}