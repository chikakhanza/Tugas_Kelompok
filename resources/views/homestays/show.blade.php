@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Homestay</h2>

    <table class="table table-bordered">
        <tr>
            <th>Kode</th>
            <td>{{ $homestay->kode }}</td>
        </tr>
        <tr>
            <th>Tipe Kamar</th>
            <td>{{ $homestay->tipe_kamar }}</td>
        </tr>
        <tr>
            <th>Harga Sewa per Hari</th>
            <td>Rp{{ number_format($homestay->harga_sewa_per_hari, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Fasilitas</th>
            <td>{{ $homestay->fasilitas }}</td>
        </tr>
        <tr>
            <th>Jumlah Kamar</th>
            <td>{{ $homestay->jumlah_kamar }}</td>
        </tr>
    </table>

    <a href="{{ route('homestays.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
