@extends('layouts.main')

@section('content')
<h1>Detail Booking</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>User:</strong> {{ $booking->user->name }}</li>
    <li class="list-group-item"><strong>Homestay:</strong> {{ $booking->homestay->kode }} - {{ $booking->homestay->tipe_kamar }}</li>
    <li class="list-group-item"><strong>Check-in:</strong> {{ $booking->check_in }}</li>
    <li class="list-group-item"><strong>Check-out:</strong> {{ $booking->check_out }}</li>
    <li class="list-group-item"><strong>Jumlah Kamar:</strong> {{ $booking->jumlah_kamar }}</li>
    <li class="list-group-item"><strong>Total Hari:</strong> {{ $booking->total_hari }}</li>
    <li class="list-group-item"><strong>Keterlambatan:</strong> {{ $booking->keterlambatan ?? 0 }} hari</li>
    <li class="list-group-item"><strong>Denda:</strong> Rp{{ number_format($booking->denda) }}</li>
    <li class="list-group-item"><strong>Total Bayar:</strong> Rp{{ number_format($booking->total_bayar) }}</li>
    @if($booking->catatan)
        <li class="list-group-item"><strong>Catatan:</strong> {{ $booking->catatan }}</li>
    @endif
</ul>
<a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
