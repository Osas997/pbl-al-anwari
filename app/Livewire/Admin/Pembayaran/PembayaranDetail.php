<?php

namespace App\Livewire\Admin\Pembayaran;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class PembayaranDetail extends Component
{

    public $pembayaran;

    public function mount($id)
    {
        $pembayaran = Pembayaran::with(['tagihan', 'tagihan.santri', 'pembayaranBank', 'pembayaranBank.bankPondok', 'pembayaranBank.bankSantri'])->where('id', $id)->where('metode_pembayaran', 'transfer')->firstOrFail();
        $this->pembayaran = $pembayaran;
    }

    public function unduhGambar()
    {
        $fileName = $this->pembayaran->pembayaranBank->bukti_transfer;
        $filePath = storage_path('app/' . $fileName);

        return response()->download($filePath);
    }

    #[On('konfirmasi-pembayaran')]
    public function konfirmasiPembayaran()
    {
        try {
            DB::beginTransaction();

            $this->pembayaran->update([
                'status' => 'dikonfirmasi',
                'id_admin' => auth('admin')->user()->id,
            ]);

            $this->pembayaran->tagihan->update([
                'status' => 'lunas',
            ]);

            flash('Berhasil Mengkonfirmasi Pembayaran', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            flash($th->getMessage(), 'error');
        }
    }

    #[On('delete-pembayaran')]
    public function deletePembayaran()
    {
        try {
            DB::beginTransaction();

            $fileName = $this->pembayaran->pembayaranBank->bukti_transfer;
            $filePath = storage_path('app/' . $fileName);

            Storage::delete($filePath);

            $this->pembayaran->pembayaranBank()->delete();

            $this->pembayaran->delete();

            flash('Berhasil Menghapus Pembayaran', 'success');

            $this->redirect('/admin/pembayaran', navigate: true);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            flash($th->getMessage(), 'error');
        }
    }

    public function render()
    {
        return view('livewire.admin.pembayaran.pembayaran-detail');
    }
}
