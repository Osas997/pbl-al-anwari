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

    #[Url('status')]
    public $status = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On("delete-santri")]
    public function delete($santri_id)
    {
        try {
            $santri = Santri::with('tagihan')->findOrFail($santri_id);
            if ($santri->tagihan()->count() > 0) {
                foreach ($santri->tagihan as $tagihan) {
                    if ($tagihan->status == 'belum lunas') {
                        $this->dispatch('toast', "Gagal Menghapus santri, Terdapat Tagihan Yang Belum Lunas");
                        return;
                    }
                }
            }
            $santri->delete();
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menghapus santri " . $th->getMessage());
        }
    }

    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    #[On('toast')]
    public function render()
    {
        $santri = Santri::searchFilter($this->search, $this->status)->orderBy('nama_santri', 'asc')->paginate(10);

        return view('livewire.admin.santri.santri-table', compact('santri'));
    }
}
