<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    protected $fillable = [
        'kode',
        'tipe_kamar',
        'harga_sewa_per_hari',
        'fasilitas',
        'jumlah_kamar',
        
    ];

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}
