<?php

namespace App\Livewire\Admin\Santri;

use App\Models\Angkatan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Santri;
use App\Models\Syahriyyah;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SantriCreate extends Component
{

    #[Validate('required', message: "Nama Santri Tidak Boleh Kosong")]
    public $nama_santri;

    #[Validate('required', message: "Nama Ayah Tidak Boleh Kosong")]
    public $nama_ayah;

    #[Validate('required', message: "Nama Ibu Tidak Boleh Kosong")]
    public $nama_ibu;

    #[Validate('required', message: "Tempat Lahir Tidak Boleh Kosong")]
    public $tempat_lahir;

    #[Validate('required', message: "Tanggal Lahir Tidak Boleh Kosong")]
    #[Validate('date', message: "Tanggal Lahir Tidak Valid")]
    public $tgl_lahir;

    #[Validate('required', message: "Alamat Tidak Boleh Kosong")]
    public $alamat;

    #[Validate('required', message: "Jenis Kelamin Tidak Boleh Kosong")]
    #[Validate('in:P,L', message: "Jenis Kelamin Tidak Valid")]
    public $jenis_kelamin;

    #[Validate('required', message: "NIS Tidak Boleh Kosong")]
    #[Validate('numeric', message: "NIS Harus Angka")]
    #[Validate('digits:18', message: "NIS Harus 18 Digit")]
    #[Validate('unique:santri,nis', message: "NIS Sudah Terdaftar")]
    public $nis;

    #[Validate('required', message: "No KK Tidak Boleh Kosong")]
    #[Validate('numeric', message: "No KK Harus Angka")]
    #[Validate('digits_between:11,13', message: "No HP Harus 11-13 Digit")]
    #[Validate('unique:santri,no_hp', message: "No HP Sudah Terdaftar")]
    public $no_hp;

    #[Validate('required', message: "No NIK Tidak Boleh Kosong")]
    #[Validate('numeric', message: "No NIK Harus Angka")]
    #[Validate('digits:16', message: "No NIK Harus 16 Digit")]
    #[Validate('unique:santri,no_nik', message: "No NIK Sudah Terdaftar")]
    public $no_nik;

    #[Validate('required', message: "Syahriyyah Tidak Boleh Kosong")]
    #[Validate('exists:syahriyyah,id', message: "Syahriyyah Tidak Valid")]
    public $id_syahriyyah;

    #[Validate('required', message: "Diniyyah Tidak Boleh Kosong")]
    #[Validate('exists:diniyyah,id', message: "Diniyyah Tidak Valid")]
    public $id_diniyyah;

    #[Validate('required', message: "Catering Tidak Boleh Kosong")]
    #[Validate('exists:catering,id', message: "Catering Tidak Valid")]
    public $id_catering;

    public $tahun_angkatan;

    public function rules()
    {
        return [
            "tahun_angkatan" => [
                'required',
                'in:' . implode(',', range(2022, Carbon::now()->year)),
            ]
        ];
    }

    public function messages()
    {
        return [
            'tahun_angkatan.required' => 'Angkatan Tidak Boleh Kosong',
            'tahun_angkatan.in' => 'Angkatan Tidak Valid',
        ];
    }

    public function store()
    {
        $validate = $this->validate();

        $validate['status'] = 'Aktif';

        $validate['tgl_lahir'] = Carbon::parse($this->tgl_lahir)->format('Y-m-d');

        $validate['password'] = Hash::make($validate['no_nik']);

        try {
            $santri = Santri::create($validate);

            $this->reset();

            flash('Berhasil Menambah Data Santri', 'success');

            $this->dispatch('santri');

            $this->dispatch('close-modal', 'create-santri-modal');
        } catch (\Throwable $th) {
            flash('Gagal Menambah Data Santri ' . $th->getMessage(), 'error');
        }
    }

    public function render()
    {
        $dataDiniyyah = Diniyyah::all();
        $dataCatering = Catering::all();
        $dataSyahriyyah = Syahriyyah::all();

        $tahunMulai = 2022;
        $tahunSaatIni = Carbon::now()->year;

        $dataTahun = range($tahunMulai, $tahunSaatIni);
        return view('livewire.admin.santri.santri-create', compact('dataDiniyyah', 'dataTahun', 'dataCatering', 'dataSyahriyyah'));
    }
}
