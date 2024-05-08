<?php

namespace App\Livewire\Santri\Pembayaran;

use App\Models\BankPondok;
use App\Models\BankSantri;
use App\Models\Pembayaran;
use App\Models\PembayaranBank;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PembayaranCreate extends Component
{
    use WithFileUploads;

    #[Validate('required', message: 'Bukti Pembayaran Harus Diisi')]
    public $buktiPembayaran;

    #[Validate('required', message: 'Bank Tujuan Harus Diisi')]
    #[Validate('exists:bank_pondok,id', message: 'Bank Tujuan Harus Valid')]
    public $idBankPondok;

    #[Validate('required', message: 'Bank Pengirim Harus Diisi')]
    #[Validate('exists:bank_santri,id', message: 'Bank Pengirim Harus Valid')]
    public $idBankSantri;

    public $tagihanId;

    public $nominalTagihan;

    public function mount($tagihanId, $nominal)
    {
        $bankPondok = BankPondok::oldest()->first();
        $bankSantri = BankSantri::where('id_santri', auth()->user()->id)->oldest()->first();

        $this->nominalTagihan = $nominal;
        $this->tagihanId = $tagihanId;
        $this->idBankPondok = $bankPondok->id;

        if ($bankSantri) {
            $this->idBankSantri = $bankSantri->id;
        }
    }

    #[On('bayar-tagihan')]
    public function store()
    {

        $validatedData = $this->validate();

        $validasiBankSantri = $this->validasiBank($validatedData['idBankSantri']);

        if (!$validasiBankSantri) {
            return;
        }

        try {
            DB::beginTransaction();

            $pembayaran = Pembayaran::create([
                "id_tagihan" => $this->tagihanId,
                "metode_pembayaran" => "transfer",
                "jumlah_bayar" => $this->nominalTagihan,
                "tanggal_bayar" => date('Y-m-d'),
                "status" => "pending"
            ]);

            $buktiBayar = $this->buktiPembayaran[0];

            $filename = auth()->user()->nis . "-bukti_bayar-" . uniqid() . '.' . $buktiBayar["extension"];

            $buktiBayarPath = Storage::putFileAs('public/bukti-pembayaran', new File($buktiBayar['path']), $filename);

            PembayaranBank::create([
                "id_pembayaran" => $pembayaran->id,
                "id_bank_pondok" => $this->idBankPondok,
                "id_bank_santri" => $this->idBankSantri,
                "bukti_transfer" => $buktiBayarPath
            ]);

            $this->dispatch('pembayaran-transfer');
            $this->dispatch('toast', 'Berhasil Melakukan Pembayaran Silahkan Tunggu Admin Untuk Melakukan Konfirmasi !');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('toast', "Gagal Melakukan Pembayaran Tagihan " . $th->getMessage());
        }
    }

    public function validasiBank($idBankSantri)
    {
        // Pastikan bahwa bank yang dipilih milik santri
        $santriBank = BankSantri::where('id', $idBankSantri)
            ->where('id_santri', auth()->user()->id)
            ->exists();

        if (!$santriBank) {
            // Bank yang dipilih bukan milik santri
            $this->addError('idBankSantri', 'Bank yang dipilih tidak valid.');
            return false;
        }

        return true;
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
