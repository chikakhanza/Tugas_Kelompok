@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Data Homestay</h2>
    <a href="{{ route('homestays.create') }}" class="btn btn-primary mb-3">Tambah Homestay</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tipe Kamar</th>
                <th>Harga Sewa/Hari</th>
                <th>Lama Inap</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($homestays as $h)
            <tr>
                <td>{{ $h->kode }}</td>
                <td>{{ $h->tipe_kamar }}</td>
                <td>Rp{{ number_format($h->harga_sewa_per_hari) }}</td>
                <td>{{ $h->lama_inap }}</td>
                <td>Rp{{ number_format($h->total_bayar) }}</td>
                <td>
                    <a href="{{ route('homestays.edit', $h->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('homestays.destroy', $h->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
