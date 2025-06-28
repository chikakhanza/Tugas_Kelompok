@extends('layouts.main')

@section('content')
<h1>Edit Booking</h1>
<form action="{{ route('bookings.update', $booking->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('bookings.form', ['booking' => $booking])
    <button class="btn btn-success">Update</button>
</form>
@endsection
