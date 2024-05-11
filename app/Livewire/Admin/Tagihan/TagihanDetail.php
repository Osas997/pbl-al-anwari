<?php

namespace App\Livewire\Admin\Tagihan;

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

    #[On('pembayaran-tunai')]
    public function render()
    {
        $isPending = false;

        foreach ($this->tagihan->pembayaran as $pembayaran) {
            if ($pembayaran->metode_pembayaran == 'transfer' && $pembayaran->status == 'pending') {
                $isPending = true;
            }
        }

        return view('livewire.admin.tagihan.tagihan-detail', compact('isPending'));
    }
}
