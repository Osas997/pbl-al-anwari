<?php

namespace App\Livewire\Admin\Rekening;

use App\Models\Bank;
use App\Models\BankPondok;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RekeningCreate extends Component
{

    #[Validate('required', message: "Nama Rekening Tidak Boleh Kosong")]
    public $nama_rekening;

    #[Validate('required', message: "Nomor Rekening Tidak Boleh Kosong")]
    public $nomor_rekening;

    #[Validate('required', message: "Bank Tidak Boleh Kosong")]
    #[Validate('exists:banks,id', message: "Bank Tidak Ditemukan")]
    public $id_bank;

    public function store()
    {
        $validate = $this->validate();

        try {

            $bank = Bank::findOrFail($this->id_bank);

            BankPondok::create([
                "nama_bank" => $bank->nama_bank,
                "sandi_bank" => $bank->sandi_bank,
                "nomor_rekening" => $validate['nomor_rekening'],
                "nama_rekening" => $validate['nama_rekening'],
            ]);

            $this->reset();

            flash('Berhasil Menambah Rekening', 'success');

            $this->dispatch('create-rekening');

            $this->dispatch('close-modal', 'create-rekening-modal');
        } catch (\Throwable $th) {
            flash('Gagal Menambah Rekening ' . $th->getMessage(), 'danger');
        }
    }

    public function render()
    {
        $dataBank = Bank::pluck('nama_bank', 'id');

        return view('livewire.admin.rekening.rekening-create', compact('dataBank'));
    }
}
