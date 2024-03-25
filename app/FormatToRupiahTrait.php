<?php

namespace App;

trait FormatToRupiahTrait
{
    public function formatToRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
