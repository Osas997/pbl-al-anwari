<?php

namespace App\Listeners;

use App\Events\GenerateTagihan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;

class NotifikasiTagihanDibuat implements ShouldQueue
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
    public function handle(GenerateTagihan $event): void
    {
        $client = new Client();

        $tagihan = $event->tagihan;

        $number = $tagihan->santri->no_hp;

        $nama_santri = $tagihan->santri->nama_santri;

        $message = "Assalamualaikum" . $nama_santri . "\nTagihan pembayaran " . $tagihan->jenis_tagihan . " anda sebesar " . $tagihan->formatToRupiah('nominal') . " sudah dibuat. Silahkan bayar secepatnya. Terima kasih.";

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