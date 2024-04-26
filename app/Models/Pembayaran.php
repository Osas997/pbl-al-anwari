<?php

namespace App\Models;

use App\FormatToRupiahTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory, FormatToRupiahTrait;
    protected $table = 'pembayaran';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }
}
