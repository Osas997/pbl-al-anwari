<?php

namespace App\Livewire\Admin\Pembayaran;

use App\Models\Pembayaran;
use Livewire\Attributes\Url;
use Livewire\Component;

class RiwayatPembayaranTable extends Component
{

    #[Url('search')]
    public $search = '';
    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    public function render()
    {
        $pembayaran = Pembayaran::with(['tagihan', 'tagihan.santri'])->where('status', 'dikonfirmasi')->search($this->search)->latest()->get();
        return view('livewire.admin.pembayaran.riwayat-pembayaran-table', compact('pembayaran'));
    }
}
