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
        $this->tagihan = $tagihan->load(['santri']);
    }

    #[On('pembayaran-transfer')]
    public function render()
    {
        $this->cekHakAkses($this->tagihan);

        $pembayaran = Pembayaran::where("id_tagihan", $this->tagihan->id)->first();

        return view('livewire.santri.tagihan.tagihan-detail', compact('pembayaran'));
    }

    public function cekHakAkses($tagihan)
    {
        if (auth()->user()->id != $tagihan->id_santri) {
            return abort(404);
        }
        return;
    }
}
