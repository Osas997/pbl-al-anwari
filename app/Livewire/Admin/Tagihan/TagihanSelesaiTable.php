<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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

    public function cetakPdf()
    {
        $tagihan = Tagihan::with('santri')->where('status', 'lunas')->searchFilter($this->search)->latest()->get();
        $pdf = Pdf::loadview('tagihan-pdf', compact('tagihan'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, Carbon::now()->format('d-m-Y') . 'tagihan-selesai.pdf');
    }
    public function render()
    {
        $tagihan =  Tagihan::with('santri')->where('status', 'lunas')->latest()->paginate(25);;
        return view('livewire.admin.tagihan.tagihan-selesai-table', compact('tagihan'));
    }
}
