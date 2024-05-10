<?php

namespace App\Livewire\Admin\Pembayaran;

use App\Models\Pembayaran;
use Livewire\Component;

class PembayaranTable extends Component
{

    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    public function render()
    {
        $pembayaran = Pembayaran::with(['tagihan', 'tagihan.santri'])->where('metode_pembayaran', 'transfer')->where('status', 'pending')->get();
        return view('livewire.admin.pembayaran.pembayaran-table', compact('pembayaran'));
    }
}
