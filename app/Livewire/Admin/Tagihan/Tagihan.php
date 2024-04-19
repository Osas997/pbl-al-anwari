<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Santri;
use App\Models\Tagihan as ModelsTagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tagihan Santri')]
class Tagihan extends Component
{

    public function cetakPdf()
    {
        $tagihan = ModelsTagihan::with('santri')->where('status', 'belum lunas')->latest()->get();
        $pdf = Pdf::loadview('tagihan-pdf', compact('tagihan'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, Carbon::now()->format('d-m-Y') . 'tagihan.pdf');
    }

    public function render()
    {
        $totalSantri = Santri::where('status', 'Aktif')->count();

        return view('livewire.admin.tagihan.tagihan', compact('totalSantri'));
    }
}
