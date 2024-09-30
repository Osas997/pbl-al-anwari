<?php

namespace App\Livewire\Santri;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MyProfile extends Component
{
    public $user;

    #[Validate('required', message: "Nama Santri Tidak Boleh Kosong")]
    public $nama_santri;

    #[Validate('required', message: "No KK Tidak Boleh Kosong")]
    #[Validate('numeric', message: "No KK Harus Angka")]
    #[Validate('digits_between:11,13', message: "No HP Harus 11-13 Digit")]
    #[Validate('unique:santri,no_hp', message: "No HP Sudah Terdaftar")]
    public $no_hp;
    #[Validate('required', message: "Tempat Lahir Tidak Boleh Kosong")]
    public $tempat_lahir;

    #[Validate('required', message: "Tanggal Lahir Tidak Boleh Kosong")]
    #[Validate('date', message: "Tanggal Lahir Tidak Valid")]
    public $tgl_lahir;

    #[Validate('required', message: "Alamat Tidak Boleh Kosong")]
    public $alamat;
    public function mount()
    {
        $user = Auth::guard('web')->user();
        $this->nama_santri = $user->nama_santri;
        $this->no_hp = $user->no_hp;
        $this->tempat_lahir = $user->tempat_lahir;
        $this->tgl_lahir = $user->tgl_lahir;
        $this->alamat = $user->alamat;
        $this->user = $user;
        // $this->tagihan = $tagihan->load(['santri', 'pembayaran']);?
    }
    public function render()
    {
        return view('livewire.santri.my-profile');
    }

    public function edit()
    {
        $validate = $this->validate();

        $validate['tgl_lahir'] = Carbon::parse($this->tgl_lahir)->format('Y-m-d');

        try {
            $this->user->update($validate);
            flash('Profile Berhasil Diubah', 'success');
        } catch (\Throwable $th) {
            flash("Profile gagal diubah" . $th->getMessage(), 'error');
        }
    }
    public function rules()
    {
        return [
            "no_hp" => [
                'required',
                'numeric',
                'digits_between:11,13',
                "unique:santri,no_hp," . $this->user->id,
            ]
        ];
    }

    public function messages()
    {
        return [
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.numeric' => 'Nomor HP harus angka.',
            'no_hp.digits' => 'No HP Harus 11-13 Digit',
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
        ];
    }
}