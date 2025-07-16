<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Homestay;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function bookingReport(Request $request)
    {
        $query = Booking::with(['user', 'homestay']);
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        $bookings = $query->get();
        return view('laporan.booking', compact('bookings'));
    }
    public function paymentReport(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.homestay']);
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('tanggal_pembayaran', [$request->start_date, $request->end_date]);
        }
        $payments = $query->get();
        return view('laporan.payment', compact('payments'));
    }
    public function pendapatanReport(Request $request)
    {
        $query = Payment::query();
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('tanggal_pembayaran', [$request->start_date, $request->end_date]);
        }
        $total_pendapatan = $query->sum('jumlah_dibayar');
        return view('laporan.pendapatan', compact('total_pendapatan'));
    }
    public function homestayReport(Request $request)
    {
        $homestays = Homestay::withCount('bookings')->with(['bookings'])->get();
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
        return view('laporan.homestay', ['homestays' => $data]);
    }
}