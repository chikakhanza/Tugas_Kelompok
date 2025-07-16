@extends('layouts.main')

@section('content')
<div class="card shadow-lg border-0 rounded-4">

    {{-- ===== HEADER ===== --}}
    <div class="card-header d-flex justify-content-between align-items-center py-3"
         style="background:linear-gradient(90deg,#ff9aa2,#ffb6c1);">
      <h3 class="mb-0 text-white d-flex align-items-center">
        <i class="bi bi-credit-card-2-front me-2"></i> Data Pembayaran
      </h3>

      <a href="{{ route('payments.create') }}"
         class="btn btn-light fw-semibold rounded-pill shadow-sm">
        ➕ Tambah Pembayaran
      </a>
    </div>

    {{-- ===== BODY ===== --}}
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="text-center" style="background:#ffd5e0;">
            <tr>
              <th>Booking</th>
              <th>Metode</th>
              <th>Tanggal</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse($payments as $p)
              <tr>
                <td>
                  <strong>{{ $p->booking->user->name ?? '-' }}</strong><br>
                  <small class="text-muted">ID: {{ $p->booking_id }}</small>
                </td>

                <td class="text-center">
                  <span class="badge bg-info text-dark text-uppercase">
                    {{ $p->metode_pembayaran }}
                  </span>
                </td>

                <td class="text-center">
                  {{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('d M Y') }}
                </td>

                <td class="text-end text-success fw-semibold">
                  Rp{{ number_format($p->jumlah_dibayar,0,',','.') }}
                </td>

                {{-- Tombol aksi bernuansa pink --}}
                <td class="text-center">
                  <div class="btn-group gap-1 d-flex flex-wrap justify-content-center">

                    <a href="{{ route('payments.show',$p->id) }}"
                       class="btn btn-sm btn-outline-pink"
                       title="Lihat">
                      🔍
                    </a>

                    <a href="{{ route('payments.edit',$p->id) }}"
                       class="btn btn-sm btn-outline-pink"
                       title="Edit">
                      ✏️
                    </a>

                    <form action="{{ route('payments.destroy',$p->id) }}"
                          method="POST" onsubmit="return confirm('Yakin hapus?')">
                      @csrf @method('DELETE')
                      <button type="submit"
                              class="btn btn-sm btn-outline-pink"
                              title="Hapus">
                        🗑️
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                  <img src="https://img.icons8.com/fluency/48/empty-box.png" alt="no data"><br>
                  Belum ada data pembayaran.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
</div>

{{-- ==== CSS PINK SENADA ==== --}}
@push('styles')
<style>
  .btn-outline-pink{
    color:#d63384;border:1px solid #d63384;
  }
  .btn-outline-pink:hover{
    background:#d63384;color:#fff;
  }
  .table tbody tr:nth-of-type(odd){background:#fff5fa;}
  .table tbody tr:hover{background:#ffe4f0;}
</style>
@endpush
@endsection
