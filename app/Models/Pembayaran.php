<?php

namespace App\Models;

use App\FormatToRupiahTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Pembayaran extends Model
{
    use HasFactory, FormatToRupiahTrait, BelongsToThrough;
    protected $table = 'pembayaran';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id');
    }

    public function pembayaranBank()
    {
        return $this->hasOne(PembayaranBank::class, 'id_pembayaran', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }

    public function santri()
    {
        return $this->belongsToThrough(Santri::class, Tagihan::class, foreignKeyLookup: [Tagihan::class => 'id_tagihan', Santri::class => 'id_santri'], localKeyLookup: [Tagihan::class => 'id', Santri::class => "id"]);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('santri', function ($q) use ($search) {
            $q->where('nama_santri', 'like', '%' . $search . '%');
        });
    }
}
