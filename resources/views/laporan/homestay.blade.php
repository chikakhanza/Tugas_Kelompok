@extends('layouts.main')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Laporan Homestay</h2>
  <div class="mb-3 text-end">
    <button type="button" class="btn btn-success d-print-none" onclick="window.print()">
      🖨️ Cetak
    </button>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Tipe Kamar</th>
            <th>Jumlah Booking</th>
            <th>Total Pendapatan</th>
          </tr>
        </thead>
        <tbody>
          @forelse($homestays as $i => $h)
            <tr>
              <td>{{ $i+1 }}</td>
              <td>{{ $h['kode'] }}</td>
              <td>{{ $h['tipe_kamar'] }}</td>
              <td>{{ $h['jumlah_booking'] }}</td>
              <td>Rp{{ number_format($h['total_pendapatan'],0,',','.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted">Tidak ada data homestay.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@push('styles')
<style>
  @media print {
    .d-print-none { display: none !important; }
    .sidebar, .navbar, .menu-inner, .menu-header, .content-footer, .btn, .alert { display: none !important; }
    body { background: #fff !important; }
    .container { max-width: 100% !important; }
  }
</style>
@endpush
@endsection 