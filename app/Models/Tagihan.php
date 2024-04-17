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

    public function scopeSearchFilter($query, $search)
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

        // if ($status) {
        //     $query->where('status', $status);
        // } else {
        //     $query->where('status', 'Aktif');
        // }
    }
}
