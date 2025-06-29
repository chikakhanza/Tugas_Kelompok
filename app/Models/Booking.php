<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'homestay_id',
        'check_in',
        'check_out',
        'jumlah_kamar',
        'total_hari',
        'keterlambatan',
        'denda',        // letakkan denda sebelum total_bayar jika ingin urutan sama dengan API
        'total_bayar',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }
}
