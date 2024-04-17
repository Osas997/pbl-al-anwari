<?php

namespace App\Livewire\Admin\Santri;

use App\Models\Santri;
use Livewire\Component;


class SantriDetail extends Component
{

    public $santri;

    public function mount(Santri $santri)
    {
        $this->santri = $santri->load(['angkatan', 'diniyyah']);
    }

    public function render()
    {
        return view('livewire.admin.santri.santri-detail')->title('Detail ' . $this->santri->nama_santri);
    }
}
