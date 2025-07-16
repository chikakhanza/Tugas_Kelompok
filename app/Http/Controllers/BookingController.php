<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Homestay;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'homestay'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $homestays = Homestay::all();
        return view('bookings.create', compact('users', 'homestays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'homestay_id' => 'required|exists:homestays,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_kamar' => 'required|integer|min:1',
            'keterlambatan' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $homestay = Homestay::findOrFail($request->homestay_id);

        // Validasi jumlah kamar tersedia
        if ($homestay->jumlah_kamar < $request->jumlah_kamar) {
            return redirect()->back()->withInput()->withErrors(['jumlah_kamar' => 'Jumlah kamar tidak mencukupi!']);
        }

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $totalHari = $checkIn->diffInDays($checkOut);

        $totalBayar = $homestay->harga_sewa_per_hari * $totalHari * $request->jumlah_kamar;

        // Hitung denda (hanya 10% per hari keterlambatan)
        $denda = 0;
        $keterlambatan = $request->keterlambatan ?? 0;
        if ($keterlambatan > 0) {
            $denda += round($totalBayar * 0.1 * $keterlambatan);
        }

        Booking::create([
            'user_id' => $request->user_id,
            'homestay_id' => $request->homestay_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'jumlah_kamar' => $request->jumlah_kamar,
            'total_hari' => $totalHari,
            'keterlambatan' => $keterlambatan,
            'denda' => $denda,
            'total_bayar' => $totalBayar,
            'catatan' => $request->catatan,
        ]);
        // Kurangi jumlah kamar di homestay
        $homestay->jumlah_kamar -= $request->jumlah_kamar;
        $homestay->save();
        Log::info('Jumlah kamar homestay setelah booking (web): ' . $homestay->jumlah_kamar);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'homestay'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $homestays = Homestay::all();
        return view('bookings.edit', compact('booking', 'users', 'homestays'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'homestay_id' => 'required|exists:homestays,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_kamar' => 'required|integer|min:1',
            'keterlambatan' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $homestay = Homestay::findOrFail($request->homestay_id);

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $totalHari = $checkIn->diffInDays($checkOut);

        $totalBayar = $homestay->harga_sewa_per_hari * $totalHari * $request->jumlah_kamar;

        $denda = 0;
        $keterlambatan = $request->keterlambatan ?? 0;
        if ($keterlambatan > 0) {
            $denda += round($totalBayar * 0.1 * $keterlambatan);
        }

        $booking->update([
            'user_id' => $request->user_id,
            'homestay_id' => $request->homestay_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'jumlah_kamar' => $request->jumlah_kamar,
            'total_hari' => $totalHari,
            'keterlambatan' => $keterlambatan,
            'denda' => $denda,
            'total_bayar' => $totalBayar,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $homestay = $booking->homestay;
        // Kembalikan jumlah kamar ke homestay
        $homestay->jumlah_kamar += $booking->jumlah_kamar;
        $homestay->save();
        Log::info('Jumlah kamar homestay setelah booking dihapus (web): ' . $homestay->jumlah_kamar);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
