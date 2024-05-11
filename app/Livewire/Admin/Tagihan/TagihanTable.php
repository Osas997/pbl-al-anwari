<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TagihanTable extends Component
{
    use WithPagination;

    #[Url('search')]
    public $search = '';

    public $status = 'belum lunas';

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

    public function changeStatus($status)
    {
        if (!$status) return;
        $this->status = $status;
    }

    public function placeholder()
    {
        return view("vendor.loading-spinner");
    }

    #[On('cetakPdf')]
    public function cetakPdf()
    {
        $tagihan = Tagihan::with('santri')->where('status', 'belum lunas')->searchFilter($this->search)->latest()->get();
        $pdf = Pdf::loadview('tagihan-pdf', compact('tagihan'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, Carbon::now()->format('d-m-Y') . 'tagihan.pdf');
    }

    #[On('toast')]
    public function render()
    {
        $tagihan = Tagihan::with('santri')->searchFilter($this->search, $this->status)->latest()->paginate(25);
        return view('livewire.admin.tagihan.tagihan-table', compact('tagihan'));
    }
}
