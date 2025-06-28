@extends('layouts.main')

@section('content')
<h1>Tambah Booking</h1>
<form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    @include('bookings.form', ['bookings' => null])
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
