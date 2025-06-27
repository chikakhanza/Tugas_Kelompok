<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'tipe_kamar',
        'harga_sewa_per_hari',
        'lama_inap',
        'total_bayar',
    ];
}
