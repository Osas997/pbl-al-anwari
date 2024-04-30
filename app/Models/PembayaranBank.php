<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranBank extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pembayaran_bank';
}
