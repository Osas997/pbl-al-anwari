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
    #[Validate('digits:16', message: "No KK Harus 16 Digit")]
    #[Validate('unique:santri,no_kk', message: "No KK Sudah Terdaftar")]
    public $no_kk;

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

    #[Validate('required', message: "Nama Ibu Tidak Boleh Kosong")]
    #[Validate('exists:angkatan,id', message: "Angkatan Tidak Valid")]
    public $id_angkatan;

    public function store()
    {
        $validate = $this->validate();

        $validate['status'] = 'Aktif';

        $validate['tgl_lahir'] = Carbon::parse($this->tgl_lahir)->format('Y-m-d');

        $validate['password'] = Hash::make($validate['no_nik']);

        try {
            $santri = Santri::create($validate);

            $santri->assignRole('santri');

            $this->reset();

            $this->dispatch('toast', 'Berhasil Menambah Santri');

            $this->dispatch('close-modal', 'create-santri-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menambah Santri " . $th->getMessage());
        }
    }
    public function render()
    {
        $dataDiniyyah = Diniyyah::all();
        $dataAngkatan = Angkatan::all();
        $dataCatering = Catering::all();
        $dataSyahriyyah = Syahriyyah::all();

        return view('livewire.admin.santri.santri-create', compact('dataDiniyyah', 'dataAngkatan', 'dataCatering', 'dataSyahriyyah'));
    }
}
