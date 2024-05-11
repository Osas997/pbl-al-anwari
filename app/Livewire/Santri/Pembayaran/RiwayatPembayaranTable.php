<?php

namespace App\Livewire\Santri\Pembayaran;

use App\Models\Tagihan;
use Livewire\Component;

class RiwayatPembayaranTable extends Component
{
    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    public function render()
    {
        $tagihan = Tagihan::with(['santri', 'pembayaran'])
            ->where('status', 'Lunas')
            ->where('id_santri', auth()->user()->id)
            ->latest()
            ->get();

        return view('livewire.santri.pembayaran.riwayat-pembayaran-table', compact('tagihan'));
    }
}
