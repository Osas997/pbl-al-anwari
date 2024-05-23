<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LaporanPembayaran extends Component
{
    #[Validate('required', message: 'Jenis Tagihan harus diisi')]
    #[Validate('in:syahriyyah,catering', message: 'Jenis Tagihan tidak valid')]
    public $jenis_tagihan = "syahriyyah";

    public $tahun_ajaran;

    public $semester;

    public $bulan;

    public function rules()
    {
        return [
            "tahun_ajaran" => [
                'required',
                'in:' . implode(',', range(2022, Carbon::now()->year)),
            ]
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajaran.required' => 'Tahun Ajaran Tidak Boleh Kosong',
            'tahun_ajaran.in' => 'Tahun Ajaran Tidak Valid',
        ];
    }


    public function cetakPdf()
    {
        $validate = $this->validate();

        $pembayaran = Pembayaran::with(['tagihan', 'santri'])->where('status', 'dikonfirmasi')->whereHas('tagihan', function ($q) use ($validate) {
            $q->where("tahun_ajaran", $validate["tahun_ajaran"]);
        })->whereHas('tagihan', function ($q) use ($validate) {
            $q->where("jenis_tagihan", $validate["jenis_tagihan"]);
        });

        $title = "Laporan Pembayaran ";

        if ($validate["jenis_tagihan"] == "syahriyyah") {
            $validate["semester"] = $this->validate([
                "semester" => 'required|in:1,2',
            ]);

            $pembayaran->whereHas("tagihan", function ($q) use ($validate) {
                $q->where("semester", $validate["semester"]);
            });

            $title .= "Syahriyyah Semester " . $this->semester . " Tahun " . $this->tahun_ajaran;

            $this->reset('bulan');
        } else {
            $validate["bulan"] = $this->validate([
                "bulan" => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            ]);

            $pembayaran->whereHas("tagihan", function ($q) use ($validate) {
                $q->where("bulan", $validate["bulan"]);
            });

            $title .= "Catering Bulan " . $this->bulan . " Tahun " . $this->tahun_ajaran;

            $this->reset('semester');
        }

        $pembayaran = $pembayaran->get();

        if ($pembayaran->isEmpty()) {
            flash("Hasil Laporan Pembayaran Tidak Ditemukan", "warning");
            return;
        }

        $pdf = Pdf::loadview('pembayaran-pdf', compact('pembayaran', 'title'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, Carbon::now()->format('d-m-Y') . " " . uniqid() . ' pembayaran.pdf');
    }
    public function render()
    {
        $tahunMulai = 2022;
        $tahunSaatIni = Carbon::now()->year;

        $tahunAjaran = range($tahunMulai, $tahunSaatIni);
        return view('livewire.admin.laporan.laporan-pembayaran', compact('tahunAjaran'));
    }
}
