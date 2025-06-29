<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'jumlah_dibayar',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
