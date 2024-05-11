<?php

namespace App\Models;

use App\FormatToRupiahTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory, FormatToRupiahTrait;

    protected $table = 'tagihan';
    protected $guarded = ['id'];

    protected $casts = [
        'tgl_tagihan' => 'date',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_tagihan', 'id');
    }

    public function sisaTagihan()
    {
        return $this->hasMany(Pembayaran::class, 'id_tagihan', 'id')->where('status', 'dikonfirmasi')->sum('jumlah_bayar');
    }



    public function scopeSearchFilter($query, $search, $status)
    {
        if ($search) {
            $query->where(fn ($query) =>
            $query->whereHas(
                'santri',
                function ($query) use ($search) {
                    $query->where('nama_santri', 'like', '%' . $search . '%')
                        ->orWhere('nis', 'like', '%' . $search . '%')
                        ->orWhere('no_nik', 'like', '%' . $search . '%')
                        ->orWhere('no_hp', 'like', '%' . $search . '%');
                }
            ));
        }

        if ($status && $status == 'lunas') {
            $query->where('status', 'lunas');
        } else {
            $query->where('status', 'belum lunas')->orWhere('status', 'angsur');
        }
    }
}
