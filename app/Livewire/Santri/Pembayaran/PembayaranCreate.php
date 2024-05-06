<?php

namespace App\Livewire\Santri\Pembayaran;

use App\Models\BankPondok;
use App\Models\BankSantri;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PembayaranCreate extends Component
{

    #[Validate('required', message: 'Bank Tujuan Harus Diisi')]
    #[Validate('exists:bank_pondok,id', message: 'Bank Tujuan Harus Valid')]
    public $idBankPondok;

    public function mount()
    {
        $bankPondok = BankPondok::oldest()->first();
        $this->idBankPondok = $bankPondok->id;
    }

    #[On('create-rekening')]
    public function render()
    {
        $rekeningSantri = auth()->user()->rekening;

        $AllRekeningPondok = BankPondok::all();

        $rekeningPondok = BankPondok::find($this->idBankPondok);

        return view('livewire.santri.pembayaran.pembayaran-create', compact('rekeningSantri', 'AllRekeningPondok', 'rekeningPondok'));
    }
}
