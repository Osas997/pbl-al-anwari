<?php

namespace App\Listeners;

use App\Events\GenerateTagihan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Client;


class NotifikasiTagihanDibuat
{
    /**
     * Create the event listener.
     */

    protected $url = "http://localhost:3000/send-message";

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

        $message = "Assalamualaikum. \nTagihan pembayaran " . $tagihan->jenis_tagihan . " anda sebesar " . $tagihan->formatToRupiah($tagihan->nominal) . " sudah dibuat. Silahkan bayar secepatnya. Terima kasih.";

        try {
            $client->request('POST', $this->url, [
                'form_params' => [
                    'number' => $number,
                    'message' => $message,
                ],
                'headers' => [
                    'Authorization' => 'bearer ' . config('app.secret_key'),
                ],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
