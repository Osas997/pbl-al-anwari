<?php

namespace App\Livewire\Admin\Pembayaran;

use App\Models\Pembayaran;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('layouts.print-template')]
#[Title('KWITANSI PEMBAYARAN')]
class KwitansiPembayaran extends Component
{

    public $pembayaran;

    public function mount(Pembayaran $pembayaran)
    {
        $this->pembayaran = $pembayaran->load(['tagihan', 'tagihan.santri']);
    }

    public function render()
    {
        if ($this->pembayaran->status !== "dikonfirmasi") {
            return abort(404);
        }

        return view('livewire.admin.pembayaran.kwitansi-pembayaran');
    }
}
