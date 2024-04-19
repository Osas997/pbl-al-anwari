<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tagihan Selesai')]
class TagihanSelesai extends Component
{
    public function render()
    {
        return view('livewire.admin.tagihan.tagihan-selesai');
    }
}
