<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Homestay;
use Illuminate\Http\Request;

class BookingController extends Controller
{
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
        ]);

        $data = $request->all();
        $data['status'] = 'pending'; // Set default status

        Booking::create($data);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }
}
