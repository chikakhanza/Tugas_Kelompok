@extends('layouts.main')

@section('content')
<div class="card shadow-lg border-0 rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary fw-bold">
            <i class="bi bi-credit-card-2-front me-2"></i>Data Pembayaran
        </h3>
        <a href="{{ route('payments.create') }}" class="btn btn-success btn-sm rounded-3 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pembayaran
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Booking</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>
                        <strong>{{ $payment->booking->user->name ?? '-' }}</strong><br>
                        <small class="text-muted">ID: {{ $payment->booking_id }}</small>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark text-uppercase">
                            {{ $payment->metode_pembayaran }}
                        </span>
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d M Y') }}
                    </td>
                    <td class="text-end text-success fw-semibold">
                        Rp{{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="{{ route('payments.show', $payment->id) }}"
                               class="btn btn-outline-info btn-sm d-flex align-items-center gap-1">
                                <i class="bi bi-eye"></i> Lihat
                            </a>

                            <a href="{{ route('payments.edit', $payment->id) }}"
                               class="btn btn-outline-warning btn-sm d-flex align-items-center gap-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"
                                        onclick="return confirm('Yakin hapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada data pembayaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
