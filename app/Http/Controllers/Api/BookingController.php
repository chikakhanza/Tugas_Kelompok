<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::with('user', 'homestay')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'homestay_id' => 'required|exists:homestays,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'status' => 'nullable|in:pending,confirmed,cancelled',
        ]);

        // Cek ketersediaan homestay
        $cek = Booking::where('homestay_id', $request->homestay_id)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
            })->exists();

        if ($cek) {
            return response()->json(['message' => 'Homestay tidak tersedia.'], 409);
        }

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'pending';

        $booking = Booking::create($data);

        return response()->json($booking, 201);
    }

    public function show(Booking $booking)
    {
        return $booking->load('user', 'homestay');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}
