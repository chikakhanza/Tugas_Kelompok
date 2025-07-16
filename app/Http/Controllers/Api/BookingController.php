<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Homestay;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'homestay'])->get();

        $data = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'user' => $booking->user,
                'homestay' => $booking->homestay,
                'check_in' => $booking->check_in,
                'check_out' => $booking->check_out,
                'jumlah_kamar' => $booking->jumlah_kamar,
                'total_hari' => $booking->total_hari,
                'keterlambatan' => $booking->keterlambatan,
                'denda' => $booking->denda,
                'total_bayar' => $booking->total_bayar,
                'catatan' => $booking->catatan,
                'created_at' => $booking->created_at,
                'updated_at' => $booking->updated_at,
            ];
        });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'homestay_id' => 'required|exists:homestays,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_kamar' => 'required|integer|min:1',
            'keterlambatan' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $homestay = Homestay::findOrFail($data['homestay_id']);
        // Cek ketersediaan kamar
        if ($homestay->jumlah_kamar < $data['jumlah_kamar']) {
            return response()->json([
                'message' => 'Jumlah kamar tidak mencukupi!'
            ], 422);
        }
        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);
        $totalHari = $checkIn->diffInDays($checkOut);

        $totalBayar = $homestay->harga_sewa_per_hari * $totalHari * $data['jumlah_kamar'];

        // Denda hanya dari keterlambatan
        $keterlambatan = $data['keterlambatan'] ?? 0;
        $denda = 0;
        if ($keterlambatan > 0) {
            $denda += round($totalBayar * 0.1 * $keterlambatan);
        }

        $data['total_hari'] = $totalHari;
        $data['denda'] = $denda;
        $data['total_bayar'] = $totalBayar + $denda;

        $booking = Booking::create($data);

        // Kurangi jumlah kamar di homestay
        $homestay->jumlah_kamar -= $data['jumlah_kamar'];
        $homestay->save();
        Log::info('Jumlah kamar homestay setelah booking: ' . $homestay->jumlah_kamar);

        return response()->json($booking->load(['user', 'homestay']), 201);
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'homestay'])->findOrFail($id);

        $data = [
            'id' => $booking->id,
            'user' => $booking->user,
            'homestay' => $booking->homestay,
            'check_in' => $booking->check_in,
            'check_out' => $booking->check_out,
            'jumlah_kamar' => $booking->jumlah_kamar,
            'total_hari' => $booking->total_hari,
            'keterlambatan' => $booking->keterlambatan,
            'denda' => $booking->denda,
            'total_bayar' => $booking->total_bayar,
            'catatan' => $booking->catatan,
            'created_at' => $booking->created_at,
            'updated_at' => $booking->updated_at,
        ];

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'homestay_id' => 'required|exists:homestays,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'jumlah_kamar' => 'required|integer|min:1',
            'keterlambatan' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $homestay = Homestay::findOrFail($data['homestay_id']);
        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);
        $totalHari = $checkIn->diffInDays($checkOut);

        $totalBayar = $homestay->harga_sewa_per_hari * $totalHari * $data['jumlah_kamar'];

        $keterlambatan = $data['keterlambatan'] ?? 0;
        $denda = 0;
        if ($keterlambatan > 0) {
            $denda += round($totalBayar * 0.1 * $keterlambatan);
        }

        $data['total_hari'] = $totalHari;
        $data['denda'] = $denda;
        $data['total_bayar'] = $totalBayar + $denda;

        $booking->update($data);

        return response()->json($booking->load(['user', 'homestay']));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $homestay = $booking->homestay;
        // Kembalikan jumlah kamar ke homestay
        $homestay->jumlah_kamar -= $booking->jumlah_kamar;
        $homestay->save();
        Log::info('Jumlah kamar homestay setelah booking dihapus: ' . $homestay->jumlah_kamar);
        $booking->delete();
        return response()->json(['message' => 'Booking deleted']);
    }
}