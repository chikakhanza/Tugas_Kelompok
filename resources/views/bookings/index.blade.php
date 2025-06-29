@extends('layouts.main')

@section('content')
<h1>Daftar Booking</h1>
<a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Tambah Booking</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Homestay</th>
            <th>Tipe Kamar</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Jumlah Kamar</th>
            <th>Total Hari</th>
            <th>Keterlambatan</th>
            <th>Denda</th>
            <th>Total Bayar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $booking)
        <tr>
            <td>{{ $booking->user->name }}</td>
            <td>{{ $booking->homestay->kode }}</td>
            <td>{{ $booking->homestay->tipe_kamar }}</td>
            <td>{{ $booking->check_in }}</td>
            <td>{{ $booking->check_out }}</td>
            <td>{{ $booking->jumlah_kamar }}</td>
            <td>{{ $booking->total_hari }}</td>
            <td>{{ $booking->keterlambatan ?? 0 }}</td>
            <td>Rp{{ number_format($booking->denda) }}</td>
            <td>Rp{{ number_format($booking->total_bayar) }}</td>
            <td>
                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Lihat</a>
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11" class="text-center">Belum ada data booking.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
