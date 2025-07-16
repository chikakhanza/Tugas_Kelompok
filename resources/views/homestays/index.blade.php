@extends('layouts.main')

@section('content')
<div class="container py-4">
  <div class="card shadow rounded-4 border-0">

    {{-- ---------- HEADER ---------- --}}
    <div class="card-header d-flex justify-content-between align-items-center px-4 py-3"
         style="background:linear-gradient(90deg,#ff9aa2,#ffb6c1);">
      <h2 class="mb-0 text-white d-flex align-items-center">
        🏨 Data Kamar
      </h2>
      <a href="{{ route('homestays.create') }}"
         class="btn btn-light fw-semibold rounded-pill">
        ➕ Tambah Kamar
      </a>
    </div>

    {{-- ---------- BODY ---------- --}}
    <div class="card-body">

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead style="background:#ffd5e0;" class="text-center">
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Tipe Kamar</th>
              <th>Harga/Hari</th>
              <th>Fasilitas</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($homestays as $index => $h)
              <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="fw-semibold">{{ $h->kode }}</td>
                <td>{{ $h->tipe_kamar }}</td>

                {{-- Harga badge --}}
                <td>
                  <span class="badge bg-success-subtle text-success fw-semibold">
                    Rp{{ number_format($h->harga_sewa_per_hari) }}
                  </span>
                </td>

                <td>{{ $h->fasilitas }}</td>
                <td class="text-center">{{ $h->jumlah_kamar }}</td>

                {{-- Tombol aksi emoji --}}
                <td class="text-center">
                  <div class="btn-group gap-1 d-flex flex-wrap justify-content-center" role="group">
                    <a href="{{ route('homestays.edit', $h->id) }}"
                       class="btn btn-sm btn-warning flex-fill"
                       title="Edit">
                      ✏️
                    </a>

                    <form action="{{ route('homestays.destroy', $h->id) }}"
                          method="POST" class="flex-fill"
                          onsubmit="return confirm('Yakin hapus kamar ini?')">
                      @csrf @method('DELETE')
                      <button type="submit"
                              class="btn btn-sm btn-danger w-100"
                              title="Hapus">
                        🗑️
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-5">
                  <img src="https://img.icons8.com/fluency/48/empty-box.png" alt="No data">
                  <p class="mt-2 mb-0 text-muted">Belum ada data kamar.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- ====== Tambahan gaya kecil ====== --}}
@push('styles')
<style>
  /* zebra‑strip + hover highlight */
  .table-hover tbody tr:nth-of-type(odd){background:#fff5f9;}
  .table-hover tbody tr:hover{background:#ffe1ec;}
</style>
@endpush
@endsection
