@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Homestay berdasarkan Tipe Kamar</h1>

    <form method="GET" action="{{ route('homestays.laporan') }}" class="mb-4">
        <div class="form-group">
            <label for="tipe_kamar">Pilih Tipe Kamar:</label>
            <select name="tipe_kamar" id="tipe_kamar" class="form-control">
                <option value="">-- Semua Tipe --</option>
                @foreach($tipeKamars as $tipe)
                    <option value="{{ $tipe }}" {{ request('tipe_kamar') == $tipe ? 'selected' : '' }}>
                        {{ $tipe }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Tampilkan</button>
    </form>

    @if($homestays->count())
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tipe Kamar</th>
                    <th>Harga Sewa/Hari</th>
                    <th>Jumlah Kamar</th>
                    <th>Fasilitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($homestays as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->tipe_kamar }}</td>
                    <td>Rp{{ number_format($item->harga_sewa_per_hari, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah_kamar }}</td>
                    <td>{{ $item->fasilitas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">Tidak ada data homestay untuk tipe kamar ini.</div>
    @endif
</div>
@endsection
