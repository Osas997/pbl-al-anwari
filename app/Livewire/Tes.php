<?php

namespace App\Livewire;

use App\Models\Santri;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.guest')]
class Tes extends Component
{
    use WithPagination;

    #[Url('s')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $santri = Santri::orderBy('nama_santri', 'asc')->paginate(20);

        return view('livewire.tes', compact('santri'));
    }
}
