<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranBank extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pembayaran_bank';

    public function bankPondok()
    {
        return $this->belongsTo(BankPondok::class, 'id_bank_pondok', 'id');
    }

    public function bankSantri()
    {
        return $this->belongsTo(BankSantri::class, 'id_bank_santri', 'id');
    }
}
