<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with('booking')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required|in:qris,transfer',
            'tanggal_pembayaran' => 'required|date',
        ]);

        // Ambil total_bayar dari booking
        $booking = Booking::findOrFail($data['booking_id']);
        $data['jumlah_dibayar'] = $booking->total_bayar;

        $payment = Payment::create($data);

        return response()->json($payment->load('booking'), 201);
    }

    public function show($id)
    {
        $payment = Payment::with('booking')->findOrFail($id);
        return response()->json($payment);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required|in:qris,transfer',
            'tanggal_pembayaran' => 'required|date',
        ]);

        // Ambil total_bayar dari booking
        $booking = Booking::findOrFail($data['booking_id']);
        $data['jumlah_dibayar'] = $booking->total_bayar;

        $payment->update($data);

        return response()->json($payment->load('booking'));
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Pembayaran berhasil dihapus.']);
    }
}