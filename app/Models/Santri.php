<?php

namespace App\Models;

use App\JenisKelaminTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Santri extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, JenisKelaminTrait;

    protected $table = "santri";

    protected $guarded = ["id"];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function syahriyyah()
    {
        return $this->belongsTo(Syahriyyah::class, 'id_syahriyyah', 'id');
    }

    public function catering()
    {
        return $this->belongsTo(Catering::class, 'id_catering', 'id');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id')->withTrashed();
    }

    public function diniyyah()
    {
        return $this->belongsTo(Diniyyah::class, 'id_diniyyah', 'id')->withTrashed();
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_santri', 'id');
    }

    public function scopeSearchFilter($query, $search, $status)
    {
        if ($search) {
            $query->where(fn ($query) =>
            $query->where('nama_santri', 'like', '%' . $search . '%')
                ->orWhere('nis', 'like', '%' . $search . '%')
                ->orWhere('no_nik', 'like', '%' . $search . '%')
                ->orWhere('no_hp', 'like', '%' . $search . '%'));
        }

        if ($status) {
            $query->where('status', $status);
        } else {
            $query->where('status', 'Aktif');
        }
        //     if ($filter == "pelakuSedang") {
        //         $query->whereHas(
        //             'surveyRespon',
        //             fn ($query) =>
        //             $query->whereBetween("skor_total_pelaku", [24, 34])
        //         );
        //     }

        //     if ($filter == "pelakuTinggi") {
        //         $query->whereHas(
        //             'surveyRespon',
        //             fn ($query) =>
        //             $query->where("skor_total_pelaku", ">=", 35)
        //         );
        //     }

        //     if ($filter == "korbanRendah") {
        //         $query->whereHas(
        //             'surveyRespon',
        //             fn ($query) =>
        //             $query->whereBetween("skor_total_korban", [1, 23])
        //         );
        //     }
        //     if ($filter == "korbanSedang") {
        //         $query->whereHas(
        //             'surveyRespon',
        //             fn ($query) =>
        //             $query->whereBetween("skor_total_korban", [24, 34])
        //         );
        //     }
        //     if ($filter == "korbanTinggi") {
        //         $query->whereHas(
        //             'surveyRespon',
        //             fn ($query) =>
        //             $query->where("skor_total_pelaku", ">=", 35)
        //         );
        //     }
        // }
    }
}
