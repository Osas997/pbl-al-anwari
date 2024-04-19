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
        $this->tagihan = $tagihan->load(['santri']);
    }

    #[On('pembayaran-tunai')]
    public function render()
    {
        $tagihanLunas = Pembayaran::where("id_tagihan", $this->tagihan->id)->first();

        return view('livewire.admin.tagihan.tagihan-detail', compact('tagihanLunas'));
    }
}
