<?php

namespace App\Livewire\Santri\Pembayaran;

use App\Models\Bank;
use App\Models\BankSantri;
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

            BankSantri::create([
                "id_santri" => auth()->user()->id,
                "nama_bank" => $bank->nama_bank,
                "sandi_bank" => $bank->sandi_bank,
                "nomor_rekening" => $validate['nomor_rekening'],
                "nama_rekening" => $validate['nama_rekening'],
            ]);

            $this->reset();

            $this->dispatch('create-rekening');

            $this->dispatch('toast', 'Berhasil Menambah Rekening');

            $this->dispatch('close-modal', 'create-rekening-modal');
        } catch (\Throwable $th) {
            $this->dispatch('toast', "Gagal Menambah Rekening " . $th->getMessage());
        }
    }

    public function render()
    {
        $dataBank = Bank::pluck('nama_bank', 'id');

        return view('livewire.santri.pembayaran.rekening-create', compact('dataBank'));
    }
}
