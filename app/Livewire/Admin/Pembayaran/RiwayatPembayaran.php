<?php

namespace App\Livewire\Admin\Pembayaran;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Riwayat Pembayaran")]
class RiwayatPembayaran extends Component
{
    public function render()
    {
        return view('livewire.admin.pembayaran.riwayat-pembayaran');
    }
}
