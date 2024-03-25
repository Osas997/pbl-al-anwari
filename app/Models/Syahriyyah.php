<?php

namespace App\Models;

use App\FormatToRupiahTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Syahriyyah extends Model
{
    use HasFactory, SoftDeletes, FormatToRupiahTrait;
    protected $table = 'syahriyyah';
    protected $guarded = ['id'];
}
