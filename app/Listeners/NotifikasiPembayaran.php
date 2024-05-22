<?php

namespace App\Listeners;

use App\Events\CreatePembayaran;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifikasiPembayaran
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
    public function handle(CreatePembayaran $event): void
    {
        $client = new Client();

        $pembayaran = $event->pembayaran;

        $number = $pembayaran->tagihan->santri->no_hp;

        $message = "Assalamualaikum. \n Terima kasih sudah melakukan membayar tagihan Anda. Sebesar " . formatToRupiah($pembayaran->nominal)  . " \n Terima kasih";

        try {
            $client->request('POST', $this->url, [
                'form_params' => [
                    'number' => $number,
                    'message' => $message,
                ],
                'headers' => [
                    'Authorization' => 'bearer ' . env('SECRET_KEY'),
                ],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
