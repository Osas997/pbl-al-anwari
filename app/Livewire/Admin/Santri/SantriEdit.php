<?php

namespace App\Livewire\Admin\Santri;

use App\Models\Angkatan;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Santri;
use App\Models\Syahriyyah;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SantriEdit extends Component
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

    public $nis;

    public $no_hp;

    public $no_nik;

    public $santri_id;

    public function rules()
    {
        return [
            "nis" => [
                'required',
                'numeric',
                'digits:18',
                "unique:santri,nis," . $this->santri_id,
            ],
            "no_hp" => [
                'required',
                'numeric',
                'digits_between:11,13',
                "unique:santri,no_hp," . $this->santri_id,
            ],
            "no_nik" => [
                'required',
                'numeric',
                'digits:16',
                "unique:santri,no_nik," . $this->santri_id,
            ],
            "tahun_angkatan" => [
                'required',
                'in:' . implode(',', range(2022, Carbon::now()->year)),
            ]
        ];
    }

    public function messages()
    {
        return [
            'nis.required' => 'NIS tidak boleh kosong.',
            'nis.numeric' => 'NIS harus angka.',
            'nis.digits' => 'NIS harus terdiri dari 18 digit.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.numeric' => 'Nomor HP harus angka.',
            'no_hp.digits' => 'No HP Harus 11-13 Digit',
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
            'no_nik.required' => 'Nomor NIK tidak boleh kosong.',
            'no_nik.numeric' => 'Nomor NIK harus angka.',
            'no_nik.digits' => 'Nomor NIK harus terdiri dari 16 digit.',
            'no_nik.unique' => 'Nomor NIK sudah terdaftar.',
            'tahun_angkatan.required' => 'Angkatan Tidak Boleh Kosong',
            'tahun_angkatan.in' => 'Angkatan Tidak Valid',
        ];
    }

    #[On('update-santri')]
    public function edit($santri_id)
    {
        $santri = Santri::findOrFail($santri_id);
        $this->santri_id = $santri->id;
        $this->nama_santri = $santri->nama_santri;
        $this->nis = $santri->nis;
        $this->no_hp = $santri->no_hp;
        $this->no_nik = $santri->no_nik;
        $this->jenis_kelamin = $santri->jenis_kelamin;
        $this->tempat_lahir = $santri->tempat_lahir;
        $this->tgl_lahir = $santri->tgl_lahir;
        $this->alamat = $santri->alamat;
        $this->nama_ayah = $santri->nama_ayah;
        $this->nama_ibu = $santri->nama_ibu;
        $this->tahun_angkatan = $santri->tahun_angkatan;
        $this->id_syahriyyah = $santri->id_syahriyyah;
        $this->id_diniyyah = $santri->id_diniyyah;
        $this->id_catering = $santri->id_catering;
        $this->dispatch('open-modal', 'edit-santri-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        $validate['tgl_lahir'] = Carbon::parse($this->tgl_lahir)->format('Y-m-d');

        try {
            Santri::find($this->santri_id)->update($validate);

            $this->reset();

            flash('Berhasil Update Data Santri', 'success');

            $this->dispatch('santri');

            $this->dispatch('close-modal', 'edit-santri-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Ubah Data Santri " . $th->getMessage());
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

        return view('livewire.admin.santri.santri-edit', compact('dataDiniyyah', 'dataTahun', 'dataCatering', 'dataSyahriyyah'));
    }
}
