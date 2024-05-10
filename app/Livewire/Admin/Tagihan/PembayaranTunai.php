<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PembayaranTunai extends Component
{
    public $tagihanId;

    #[Validate('required', message: 'Tanggal Bayar Tidak Boleh Kosong')]
    #[Validate('date', message: 'Format Tanggal Tidak Valid')]
    public $tanggal_bayar;

    #[Validate('required', message: 'Jumlah Bayar Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'Jumlah Bayar Tidak Valid')]
    #[Validate('gte:nominalTagihan')]
    public $jumlah_bayar;

    public $nominalTagihan;

    public function messages()
    {
        $nominal = formatToRupiah($this->nominalTagihan);
        return [
            'jumlah_bayar.gte' => 'Jumlah Bayar Tidak Boleh Kurang Dari ' . $nominal
        ];
    }

    public function mount($tagihanId, $nominal)
    {
        $this->tagihanId = $tagihanId;
        $this->jumlah_bayar = $nominal;
        $this->nominalTagihan = $nominal;
    }

    #[On('bayar-tagihan')]
    public function bayar()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $tagihan = Tagihan::findOrFail($this->tagihanId);

            Pembayaran::create([
                "id_tagihan" => $this->tagihanId,
                "id_admin" => auth("admin")->user()->id,
                "metode_pembayaran" => "tunai",
                "jumlah_bayar" => $this->jumlah_bayar,
                "tanggal_bayar" => $this->tanggal_bayar,
                "status" => "dikonfirmasi"
            ]);

            $tagihan->update([
                "status" => "lunas"
            ]);

            $this->dispatch('pembayaran-tunai');
            flash('Berhasil Melakukan Pembayaran Tagihan !', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('toast', "Gagal Melakukan Pembayaran Tagihan " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.tagihan.pembayaran-tunai');
    }
}
