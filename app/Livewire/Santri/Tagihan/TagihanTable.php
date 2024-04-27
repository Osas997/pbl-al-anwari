<?php

namespace App\Livewire\Santri\Tagihan;

use App\Models\Tagihan;
use Livewire\Component;

class TagihanTable extends Component
{
    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    public function render()
    {
        $tagihan = Tagihan::with('santri')->where('id_santri', auth()->user()->id)->latest()->get();

        return view('livewire.santri.tagihan.tagihan-table', compact('tagihan'));
    }
}
