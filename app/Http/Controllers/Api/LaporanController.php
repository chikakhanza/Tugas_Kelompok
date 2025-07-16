<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Homestay;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // Laporan Booking
    public function booking(Request $request)
    {
        $query = Booking::with(['user', 'homestay']);
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        $bookings = $query->get();
        return response()->json($bookings);
    }

    // Laporan Payment
    public function payment(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.homestay']);
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('tanggal_pembayaran', [$request->start_date, $request->end_date]);
        }
        $payments = $query->get();
        return response()->json($payments);
    }

    // Laporan Homestay
    public function homestay(Request $request)
    {
        $homestays = Homestay::withCount('bookings')->with(['bookings' => function($q) {
            $q->select('homestay_id', DB::raw('SUM(total_bayar) as total_pendapatan'));
        }])->get();

        $data = $homestays->map(function($homestay) {
            $totalPendapatan = $homestay->bookings->sum('total_bayar');
            return [
                'id' => $homestay->id,
                'kode' => $homestay->kode,
                'tipe_kamar' => $homestay->tipe_kamar,
                'jumlah_booking' => $homestay->bookings_count,
                'total_pendapatan' => $totalPendapatan,
            ];
        });
        return response()->json($data);
    }

    // Laporan Pendapatan
    public function pendapatan(Request $request)
    {
        $query = Payment::query();
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('tanggal_pembayaran', [$request->start_date, $request->end_date]);
        }
        $total = $query->sum('jumlah_dibayar');
        return response()->json([
            'total_pendapatan' => $total
        ]);
    }
} 