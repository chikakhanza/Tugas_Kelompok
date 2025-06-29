<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.user')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = Booking::with('user')->get(['id', 'user_id', 'total_bayar']);
        return view('payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required|in:qris,transfer,tunai', // ✅ tambahkan tunai
            'tanggal_pembayaran' => 'required|date',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        Payment::create([
            'booking_id' => $request->booking_id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_dibayar' => $booking->total_bayar,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $payment = Payment::with('booking.user')->findOrFail($id);
        return view('payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $bookings = Booking::with('user')->get(['id', 'user_id', 'total_bayar']);
        return view('payments.edit', compact('payment', 'bookings'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required|in:qris,transfer,tunai', // ✅ tambahkan tunai
            'tanggal_pembayaran' => 'required|date',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        $payment->update([
            'booking_id' => $request->booking_id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'jumlah_dibayar' => $booking->total_bayar,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
