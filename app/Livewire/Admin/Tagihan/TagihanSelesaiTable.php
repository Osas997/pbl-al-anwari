<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TagihanSelesaiTable extends Component
{
    use WithPagination;

    #[Url('s')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }
    public function render()
    {
        $tagihan =  Tagihan::with('santri')->where('status', 'lunas')->searchFilter($this->search)->latest()->paginate(25);;
        return view('livewire.admin.tagihan.tagihan-selesai-table', compact('tagihan'));
    }
}
