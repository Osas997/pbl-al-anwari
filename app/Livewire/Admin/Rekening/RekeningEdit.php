<?php

namespace App\Livewire\Admin\Rekening;

use App\Models\Bank;
use App\Models\BankPondok;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RekeningEdit extends Component
{

    #[Validate('required', message: "Nama Rekening Tidak Boleh Kosong")]
    public $nama_rekening;

    #[Validate('required', message: "Nomor Rekening Tidak Boleh Kosong")]
    public $nomor_rekening;

    #[Validate('required', message: "Bank Tidak Boleh Kosong")]
    #[Validate('exists:banks,id', message: "Bank Tidak Ditemukan")]
    public $id_bank;

    public $rekening_id;

    #[On('edit-rekening')]
    public function edit($rekening_id)
    {
        $rekening = BankPondok::findOrFail($rekening_id);
        $bankPondok = Bank::where('sandi_bank', $rekening->sandi_bank)->firstOrFail();

        $this->rekening_id = $rekening->id;
        $this->nomor_rekening = $rekening->nomor_rekening;
        $this->nama_rekening = $rekening->nama_rekening;
        $this->id_bank = $bankPondok->id;
        $this->dispatch('update-select2', idBank: $bankPondok->id);
        $this->dispatch('open-modal', 'edit-rekening-modal');
    }

    public function update()
    {
        $validate = $this->validate();

        try {
            $bank = Bank::findOrFail($this->id_bank);

            BankPondok::find($this->rekening_id)->update([
                "nama_bank" => $bank->nama_bank,
                "sandi_bank" => $bank->sandi_bank,
                "nomor_rekening" => $validate['nomor_rekening'],
                "nama_rekening" => $validate['nama_rekening'],
            ]);

            $this->reset();

            flash('Berhasil Ubah Rekening', 'success');

            $this->dispatch('update-rekening');

            $this->dispatch('close-modal', 'edit-rekening-modal');
        } catch (\Throwable $th) {
            flash('Gagal Mengubah Rekening ' . $th->getMessage(), 'danger');
        }
    }
    public function render()
    {
        $dataBank = Bank::pluck('nama_bank', 'id');

        return view('livewire.admin.rekening.rekening-edit', compact('dataBank'));
    }
}
