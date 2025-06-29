@extends('layouts.main')
@section('content')
<h2>Detail Pembayaran</h2>
<div class="card" style="max-width: 400px;">
    <div class="card-body">
        <p><strong>Booking:</strong>
            {{ $payment->booking->user->name ?? '-' }}<br>
            (ID: {{ $payment->booking_id }})
        </p>
        <p><strong>Metode:</strong> {{ ucfirst($payment->metode_pembayaran) }}</p>
        <p><strong>Tanggal:</strong> {{ $payment->tanggal_pembayaran }}</p>
        <p><strong>Jumlah:</strong> Rp{{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}</p>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
