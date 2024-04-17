<?php

namespace App;

trait FormatToRupiahTrait
{
    public function formatToRupiah($field)
    {
        $amount = $this->attributes[$field];
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
