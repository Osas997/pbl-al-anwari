<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TagihanTable extends Component
{
    use WithPagination;

    #[Url('s')]
    public $search = '';


    #[On('delete-tagihan')]
    public function deleteTagihan(Tagihan $tagihan)
    {
        try {
            if ($tagihan->status == 'lunas') {
                $this->dispatch('toast', "Gagal Menghapus Tagihan, Tagihan Telah Lunas");
                return;
            }

            $tagihan->delete();
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus Tagihan " . $th->getMessage());
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    #[On('toast')]
    public function render()
    {
        $tagihan = Tagihan::with('santri')->where('status', 'belum lunas')->searchFilter($this->search)->latest()->paginate(25);
        return view('livewire.admin.tagihan.tagihan-table', compact('tagihan'));
    }
}
