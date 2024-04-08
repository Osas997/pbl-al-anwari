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

    #[On("delete-santri")]
    public function delete($santri_id)
    {
        try {
            $santri = Santri::findOrFail($santri_id);
            $santri->delete();
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus santri " . $th->getMessage());
        }
    }

    public function placeholder()
    {
        return view("vendor.livewire.loading-spinner");
    }

    #[On('toast')]
    public function render()
    {
        $santri = Santri::searchFilter($this->search)->orderBy('nama_santri', 'asc')->paginate(15);

        return view('livewire.admin.santri.santri-table', compact('santri'));
    }
}
