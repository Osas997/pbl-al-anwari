<?php

namespace App\Livewire\Admin\Santri;

use App\Models\Santri;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SantriTable extends Component
{
    use WithPagination;

    #[Url('s')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('toast')]
    public function render()
    {
        $santri = Santri::searchFilter($this->search)->orderBy('nama_santri', 'asc')->paginate(2);

        return view('livewire.admin.santri.santri-table', compact('santri'));
    }
}
