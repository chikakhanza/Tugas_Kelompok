@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary">📋 Daftar Booking</h1>

    <a href="{{ route('bookings.create') }}" class="btn btn-success mb-3">
        ➕ Tambah Booking
    </a>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center shadow-sm">
            <thead class="table-dark">
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
                    <td><span class="badge bg-danger">Rp{{ number_format($booking->denda) }}</span></td>
                    <td><span class="badge bg-success">Rp{{ number_format($booking->total_bayar) }}</span></td>
                    <td>
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-outline-info btn-sm mb-1" title="Lihat Detail">
                            🔍
                        </a>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-outline-warning btn-sm mb-1" title="Edit Data">
                            ✏️
                        </a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus data?')" title="Hapus Data">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-muted text-center">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
