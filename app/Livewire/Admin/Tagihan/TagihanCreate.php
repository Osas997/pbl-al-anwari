<?php

namespace App\Livewire\Admin\Tagihan;

use App\Events\GenerateTagihan;
use App\Models\Angkatan;
use App\Models\Catering;
use App\Models\Santri;
use App\Models\Syahriyyah;
use App\Models\Tagihan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TagihanCreate extends Component
{

    #[Validate('required', message: 'Jenis Tagihan harus diisi')]
    #[Validate('in:syahriyyah,catering', message: 'Jenis Tagihan tidak valid')]
    public $jenis_tagihan;

    #[Validate('required', message: 'Tahun Ajaran harus diisi')]
    #[Validate('exists:angkatan,tahun_angkatan', message: 'Tahun Ajaran tidak valid')]
    public $tahun_ajaran;

    public $semester;

    public $bulan;

    public function generate()
    {
        $validate = $this->validate();

        if ($validate["jenis_tagihan"] == "syahriyyah") {
            $this->validate([
                "semester" => 'required|in:1,2',
            ]);
            $this->reset('bulan');
        } else {
            $this->validate([
                "bulan" => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            ]);
            $this->reset('semester');
        }

        $dataSantri = Santri::with(['syahriyyah', 'catering'])->where('status', 'Aktif');

        // if ($validate["jenis_tagihan"] == "catering") {
        //     $dataSantri = $dataSantri->whereHas('syahriyyah', fn ($q) => $q->where('jenis_domisili', 'Mukim'));
        // }

        $dataSantri = $dataSantri->get();

        try {
            DB::beginTransaction();

            foreach ($dataSantri as $santri) {
                $nominal = $validate["jenis_tagihan"] == "syahriyyah" ? $santri->syahriyyah->biaya : $santri->catering->biaya;

                $tagihan = Tagihan::create([
                    "id_santri" => $santri->id,
                    "jenis_tagihan" => $validate["jenis_tagihan"],
                    "nominal" => $nominal,
                    "tgl_tagihan" => Carbon::now('Asia/Jakarta'),
                    "status" => "belum lunas",
                    "tahun_ajaran" => $validate["tahun_ajaran"],
                    "semester" => $this->semester,
                    "bulan" => $this->bulan
                ]);

                // GenerateTagihan::dispatch($tagihan);
            }

            $this->reset();

            $this->dispatch('toast', 'Berhasil Membuat Tagihan Dan Mengirim Notifikasi Untuk Semua Santri');

            $this->dispatch('close-modal', 'create-tagihan-modal');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('toast', "Gagal Membuat Tagihan Atau Gagal Mengirim Notifikasi ");
        }
    }

    public function render()
    {
        $dataSyahriyyah = Syahriyyah::all();
        $dataCatering = Catering::all();
        $dataAngkatan = Angkatan::all();

        $totalSantri = Santri::where('status', 'Aktif')->count();

        return view('livewire.admin.tagihan.tagihan-create', compact('totalSantri', 'dataSyahriyyah', 'dataCatering', 'dataAngkatan'));
    }
}
