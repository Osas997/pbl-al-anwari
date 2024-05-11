<?php

namespace App\Livewire\Santri\Tagihan;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detail Tagihan')]
class TagihanDetail extends Component
{
    public $tagihan;
    public function mount(Tagihan $tagihan)
    {
        $this->tagihan = $tagihan->load(['santri', 'pembayaran']);
    }

    #[On('pembayaran-transfer')]
    public function render()
    {
        $this->cekHakAkses($this->tagihan);

        $isPending = false;

        foreach ($this->tagihan->pembayaran as $pembayaran) {
            if ($pembayaran->metode_pembayaran == 'transfer' && $pembayaran->status == 'pending') {
                $isPending = true;
            }
        }

        return view('livewire.santri.tagihan.tagihan-detail', compact('isPending'));
    }

    public function cekHakAkses($tagihan)
    {
        if (auth()->user()->id != $tagihan->id_santri) {
            return abort(404);
        }
        return;
    }
}
