<?php

namespace App\Livewire\Admin\Pembayaran;

use App\Models\Pembayaran;
use Livewire\Component;

class RiwayatPembayaranTable extends Component
{
    public function render()
    {
        $pembayaran = Pembayaran::with(['tagihan', 'tagihan.santri'])->where('status', 'dikonfirmasi')->latest()->get();
        return view('livewire.admin.pembayaran.riwayat-pembayaran-table', compact('pembayaran'));
    }
}
