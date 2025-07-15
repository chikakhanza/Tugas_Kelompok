@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Data Kamar</h2>
            <a href="{{ route('homestays.create') }}" class="btn btn-primary">Tambah Kamar</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tipe Kamar</th>
                            <th>Harga Sewa/Hari</th>
                            <th>Fasilitas</th>
                            <th>Jumlah Kamar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($homestays as $index => $h)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $h->kode }}</td>
                            <td>{{ $h->tipe_kamar }}</td>
                            <td>Rp{{ number_format($h->harga_sewa_per_hari) }}</td>
                            <td>{{ $h->fasilitas }}</td>
                            <td>{{ $h->jumlah_kamar }}</td>
                            <td class="text-center">
                                <a href="{{ route('homestays.edit', $h->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('homestays.destroy', $h->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data kamar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
