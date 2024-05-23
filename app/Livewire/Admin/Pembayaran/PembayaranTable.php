<?php

namespace App\Livewire\Admin\Pembayaran;

use App\Http\Middleware\Santri;
use App\Models\Pembayaran;
use Livewire\Attributes\Url;
use Livewire\Component;

class PembayaranTable extends Component
{

    #[Url('search')]
    public $search = '';

    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    public function render()
    {
        $pembayaran = Pembayaran::with(['tagihan', 'tagihan.santri'])->where('metode_pembayaran', 'transfer')->where('status', 'pending')->search($this->search)->get();
        return view('livewire.admin.pembayaran.pembayaran-table', compact('pembayaran'));
    }
}
