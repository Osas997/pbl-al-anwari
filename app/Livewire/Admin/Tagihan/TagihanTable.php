<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TagihanTable extends Component
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
        $tagihan = Tagihan::with('santri')->where('status', 'belum lunas')->searchFilter($this->search)->latest()->paginate(25);
        return view('livewire.admin.tagihan.tagihan-table', compact('tagihan'));
    }
}
