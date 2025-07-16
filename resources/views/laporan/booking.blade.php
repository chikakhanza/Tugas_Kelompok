@extends('layouts.main')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Laporan Booking</h2>
  <form method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
      <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Tanggal Mulai">
    </div>
    <div class="col-md-3">
      <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="Tanggal Akhir">
    </div>
    <div class="col-md-3">
      <button class="btn btn-primary" type="submit">Filter</button>
    </div>
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-success d-print-none" onclick="window.print()">
        🖨️ Cetak
      </button>
    </div>
  </form>
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>User</th>
            <th>Homestay</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Jumlah Kamar</th>
            <th>Total Hari</th>
            <th>Total Bayar</th>
          </tr>
        </thead>
        <tbody>
          @forelse($bookings as $i => $b)
            <tr>
              <td>{{ $i+1 }}</td>
              <td>{{ $b->user->name ?? '-' }}</td>
              <td>{{ $b->homestay->kode ?? '-' }} ({{ $b->homestay->tipe_kamar ?? '-' }})</td>
              <td>{{ $b->check_in }}</td>
              <td>{{ $b->check_out }}</td>
              <td>{{ $b->jumlah_kamar }}</td>
              <td>{{ $b->total_hari }}</td>
              <td>Rp{{ number_format($b->total_bayar,0,',','.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">Tidak ada data booking.</td>
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