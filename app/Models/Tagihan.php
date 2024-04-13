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


    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id');
    }
}
