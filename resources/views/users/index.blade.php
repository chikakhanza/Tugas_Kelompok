@extends('layouts.main')

@section('content')
<div class="container py-4">
  <div class="card shadow rounded-4 border-0">

    {{-- ========= HEADER ========= --}}
    <div class="card-header d-flex justify-content-between align-items-center p-3 text-dark"
         style="background:linear-gradient(90deg,#ffd1d6,#ff9aa2);">
      <h2 class="mb-0 d-flex align-items-center">
        <i class="fas fa-users me-2"></i> Daftar Pengguna
      </h2>
      <a href="{{ route('users.create') }}"
         class="btn btn-sm fw-semibold shadow-sm"
         style="background:#ff9aa2;border:none;color:#352626;">
        ➕ Tambah
      </a>
    </div>

    {{-- ========= BODY ========= --}}
    <div class="card-body">

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="text-center" style="background:#ffd1d6;">
            <tr>
              <th style="width:70px;">No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Password</th>
              <th style="width:200px;">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($users as $index => $user)
              <tr>
                {{-- No --}}
                <td class="text-center">
                  <span class="badge rounded-pill fs-6" style="background:#ffa3b1;">
                    {{ $index + 1 }}
                  </span>
                </td>

                {{-- Data --}}
                <td class="fw-semibold">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><code class="text-muted">••••••</code></td>

                {{-- ====== TOMBOL AKSI EMOJI ====== --}}
                <td class="text-center">
                  <div class="btn-group d-flex flex-wrap justify-content-center gap-1" role="group">

                    {{-- 👁️ Lihat --}}
                    <a href="{{ route('users.show', $user->id) }}"
                       class="btn btn-sm btn-coral flex-fill"
                       title="Lihat">
                      👁️
                    </a>

                    {{-- ✏️ Edit --}}
                    <a href="{{ route('users.edit', $user->id) }}"
                       class="btn btn-sm btn-amber flex-fill"
                       title="Edit">
                      ✏️
                    </a>

                    {{-- 🗑️ Hapus --}}
                    <form action="{{ route('users.destroy', $user->id) }}"
                          method="POST" class="flex-fill"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-plum w-100"
                              title="Hapus">
                        🗑️
                      </button>
                    </form>

                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-5">
                  <img src="https://img.icons8.com/fluency/48/empty-box.png" alt="No data">
                  <p class="mt-2 mb-0 text-muted">Belum ada data pengguna.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- ========= KUSTOM CSS WARNA TOMBOL ========= --}}
@push('styles')
<style>
  .btn-coral {
    background:#ffa3b1; color:#352626; border:none;
  }
  .btn-coral:hover { background:#ff8a9c; color:#352626; }

  .btn-amber {
    background:#ffcf91; color:#4a3725; border:none;
  }
  .btn-amber:hover { background:#ffbd68; color:#4a3725; }

  .btn-plum {
    background:#c29ff0; color:#fff; border:none;
  }
  .btn-plum:hover { background:#aa7def; color:#fff; }
</style>
@endpush

{{-- ========= TOOLTIP SCRIPT ========= --}}
@push('scripts')
<script>
  document.querySelectorAll('[title]').forEach(el => new bootstrap.Tooltip(el));
</script>
@endpush
@endsection
