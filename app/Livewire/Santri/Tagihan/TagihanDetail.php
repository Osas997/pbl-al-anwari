<?php

namespace App\Livewire\Santri\Tagihan;

use App\Models\Pembayaran;
use App\Models\Tagihan;
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

    public function render()
    {
        $this->cekHakAkses($this->tagihan);

        $tagihanLunas = Pembayaran::where("id_tagihan", $this->tagihan->id)->first();

        return view('livewire.santri.tagihan.tagihan-detail', compact('tagihanLunas'));
    }

    public function cekHakAkses($tagihan)
    {
        if (auth()->user()->id != $tagihan->id_santri) {
            return abort(404);
        }
        return;
    }
}
