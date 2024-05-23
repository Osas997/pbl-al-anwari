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
            'tahun_ajaran.required' => 'Angkatan Tidak Boleh Kosong',
            'tahun_ajaran.in' => 'Angkatan Tidak Valid',
        ];
    }

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

                // GenerateTagihan::dispatch($tagihan->load('santri'));
            }

            $this->reset();

            flash("Tagihan Berhasil Dibuat", "success");

            $this->dispatch('close-modal', 'create-tagihan-modal');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            flash("Tagihan Gagal Dibuat" . $th->getMessage(), "error");
        }
    }

    public function render()
    {
        $dataSyahriyyah = Syahriyyah::all();
        $dataCatering = Catering::all();

        $tahunMulai = 2022;
        $tahunSaatIni = Carbon::now()->year;

        $dataTahun = range($tahunMulai, $tahunSaatIni);

        $totalSantri = Santri::where('status', 'Aktif')->count();

        return view('livewire.admin.tagihan.tagihan-create', compact('totalSantri', 'dataSyahriyyah', 'dataCatering', 'dataTahun'));
    }
}
