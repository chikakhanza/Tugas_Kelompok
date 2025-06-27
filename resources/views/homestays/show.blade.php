@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Detail Homestay</h2>
    <table class="table">
        <tr><th>Kode</th><td>{{ $homestay->kode }}</td></tr>
        <tr><th>Tipe Kamar</th><td>{{ $homestay->tipe_kamar }}</td></tr>
        <tr><th>Harga Sewa per Hari</th><td>Rp{{ number_format($homestay->harga_sewa_per_hari) }}</td></tr>
        <tr><th>Lama Inap</th><td>{{ $homestay->lama_inap }}</td></tr>
        <tr><th>Total Bayar</th><td>Rp{{ number_format($homestay->total_bayar) }}</td></tr>
    </table>
    <a href="{{ route('homestays.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
