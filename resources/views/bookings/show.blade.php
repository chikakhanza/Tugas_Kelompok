@extends('layouts.main')

@section('content')
<h1>Detail Booking</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>User:</strong> {{ $booking->user->name }}</li>
    <li class="list-group-item"><strong>Homestay:</strong> {{ $booking->homestay->nama }}</li>
    <li class="list-group-item"><strong>Check-in:</strong> {{ $booking->check_in }}</li>
    <li class="list-group-item"><strong>Check-out:</strong> {{ $booking->check_out }}</li>
    <li class="list-group-item"><strong>Status:</strong> {{ $booking->status }}</li>
</ul>
<a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
