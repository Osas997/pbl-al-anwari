<?php

namespace App\Livewire\Admin\Tagihan;

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
        return view('livewire.admin.tagihan.tagihan-detail');
    }
}
