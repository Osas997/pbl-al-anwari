<?php

namespace App\Livewire\Admin\Tagihan;

use App\Events\CreatePembayaran;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Carbon\Carbon;
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
    #[Validate('min:0', message: 'Jumlah Bayar Tidak Boleh Kurang Dari Rp. 0')]
    public $jumlah_bayar;

    public $nominalTagihan;

    public function mount($tagihanId, $nominal, $sisaTagihan)
    {
        $this->tagihanId = $tagihanId;
        $this->jumlah_bayar = $nominal - $sisaTagihan;
        $this->nominalTagihan = $nominal;
        $this->tanggal_bayar = Carbon::now()->format('Y-m-d');
    }

    #[On('bayar-tagihan')]
    public function bayar()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $tagihan = Tagihan::with('pembayaran')->findOrFail($this->tagihanId);

            $pembayaran = Pembayaran::create([
                "id_tagihan" => $this->tagihanId,
                "id_admin" => auth("admin")->user()->id,
                "metode_pembayaran" => "tunai",
                "jumlah_bayar" => $this->jumlah_bayar,
                "tanggal_bayar" => $this->tanggal_bayar,
                "status" => "dikonfirmasi"
            ]);

            $jumlah_bayar = $tagihan->pembayaran->sum('jumlah_bayar') + $this->jumlah_bayar;

            if ($jumlah_bayar >= $this->nominalTagihan) {
                $tagihan->update([
                    "status" => "lunas"
                ]);
            } else {
                $tagihan->update([
                    "status" => "angsur"
                ]);
            }

            $this->reset('tanggal_bayar', 'jumlah_bayar');

            // CreatePembayaran::dispatch($pembayaran->load(['tagihan', 'tagihan.santri']));

            $this->dispatch('pembayaran-tunai');
            flash('Berhasil Melakukan Pembayaran Tagihan !', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            flash('Gagal Melakukan Pembayaran Tagihan !' . $th->getMessage(), 'error');
        }
    }

    public function render()
    {
        return view('livewire.admin.tagihan.pembayaran-tunai');
    }
}
