@extends('layouts.main')

@section('content')
<div class="container py-4">

  {{-- === HEADER GRADASI PINK === --}}
  <div class="card shadow rounded-4 border-0">
    <div class="card-header d-flex justify-content-between align-items-center px-4 py-3"
         style="background:linear-gradient(90deg,#ff9aa2,#ffb6c1);">
      <h2 class="mb-0 text-white d-flex align-items-center">
        📋 Daftar Booking
      </h2>
      <a href="{{ route('bookings.create') }}"
         class="btn btn-light fw-semibold rounded-pill shadow-sm">
        ➕ Tambah Booking
      </a>
    </div>

    {{-- === BODY === --}}
    <div class="card-body">

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="text-center" style="background:#ffd5e0;">
            <tr>
              <th>User</th>
              <th>Homestay</th>
              <th>Tipe</th>
              <th>Check‑in</th>
              <th>Check‑out</th>
              <th>Jml</th>
              <th>Hari</th>
              <th>Keterlambatan</th>
              <th>Denda</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($bookings as $b)
              <tr>
                <td>{{ $b->user->name }}</td>
                <td>{{ $b->homestay->kode }}</td>
                <td>{{ $b->homestay->tipe_kamar }}</td>
                <td>{{ $b->check_in }}</td>
                <td>{{ $b->check_out }}</td>
                <td>{{ $b->jumlah_kamar }}</td>
                <td>{{ $b->total_hari }}</td>
                <td>{{ $b->keterlambatan ?? 0 }}</td>

                {{-- Badge uang seragam dgn homestay --}}
                <td>
                  <span class="badge bg-danger-subtle text-danger">
                    Rp{{ number_format($b->denda) }}
                  </span>
                </td>
                <td>
                  <span class="badge bg-success-subtle text-success">
                    Rp{{ number_format($b->total_bayar) }}
                  </span>
                </td>

                {{-- Tombol aksi emoji --}}
                <td class="text-center">
                  <div class="btn-group gap-1 d-flex flex-wrap justify-content-center">
                    <a href="{{ route('bookings.show', $b->id) }}"
                       class="btn btn-sm btn-outline-pink flex-fill"
                       title="Lihat">
                      🔍
                    </a>
                    <a href="{{ route('bookings.edit', $b->id) }}"
                       class="btn btn-sm btn-outline-pink flex-fill"
                       title="Edit">
                      ✏️
                    </a>
                    <form action="{{ route('bookings.destroy', $b->id) }}"
                          method="POST" class="flex-fill"
                          onsubmit="return confirm('Hapus data?')">
                      @csrf @method('DELETE')
                      <button type="submit"
                              class="btn btn-sm btn-outline-pink w-100"
                              title="Hapus">
                        🗑️
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="11" class="text-center py-5">
                  <img src="https://img.icons8.com/fluency/48/empty-box.png" alt="No data">
                  <p class="mt-2 mb-0 text-muted">Belum ada data booking.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- === STYLING TAMBAHAN PINK === --}}
@push('styles')
<style>
  .btn-outline-pink {
    color:#d63384;border:1px solid #d63384;
  }
  .btn-outline-pink:hover{background:#d63384;color:#fff;}

  /* zebra + hover senada */
  .table tbody tr:nth-of-type(odd){background:#fff5fa;}
  .table tbody tr:hover{background:#ffe4f0;}
</style>
@endpush
@endsection
