<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Livewire\Component;

class TagihanTable extends Component
{
    public function render()
    {
        $tagihan = Tagihan::where('status', 'belum lunas')->get();
        return view('livewire.admin.tagihan.tagihan-table');
    }
}
