<?php


namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Homestay;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'homestay')->get();
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
            'check_out' => 'required|date|after_or_equal:check_in',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function edit(Booking $booking)
    {
        $users = User::all();
        $homestays = Homestay::all();
        return view('bookings.edit', compact('booking', 'users', 'homestays'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'homestay_id' => 'required|exists:homestays,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diupdate.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}