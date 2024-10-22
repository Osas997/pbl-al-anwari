<?php

namespace App\Listeners;

use App\Events\CreatePembayaran;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifikasiPembayaran implements ShouldQueue
{
    use Queueable;
    /**
     * Create the event listener.
     */

    protected $url = "https://api.fonnte.com/send";

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreatePembayaran $event): void
    {
        $client = new Client();

        $pembayaran = $event->pembayaran;

        $number = $pembayaran->tagihan->santri->no_hp;

        $nama_santri = $pembayaran->tagihan->santri->nama_santri;

        $messageKeterangan = $pembayaran->tagihan->jenis_tagihan == "catering" ? "pada bulan " . $pembayaran->tagihan->bulan : "pada semester " . $pembayaran->tagihan->semester;

        $message = "Assalamualaikum ". $nama_santri . "\nTerima kasih sudah membayar tagihan ". $pembayaran->tagihan->jenis_tagihan . " " . $messageKeterangan . " Tahun " .$pembayaran->tagihan->tahun_ajaran . " anda sebesar " . "*" . formatToRupiah($pembayaran->jumlah_bayar)  . "*" . "  Terima kasih";

        try {
            $client->request('POST', $this->url, [
                'form_params' => [
                    'target' => $number,
                    'message' => $message,
                ],
                'headers' => [
                    'Authorization' => 'buaSzEaEwZ8rKS+SqpMv',
                ],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}