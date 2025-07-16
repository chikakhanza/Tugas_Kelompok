@extends('layouts.main')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Laporan Pendapatan</h2>
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
      <h4>Total Pendapatan: <span class="text-success">Rp{{ number_format($total_pendapatan,0,',','.') }}</span></h4>
      @if($total_pendapatan == 0)
        <div class="alert alert-info mt-3">Belum ada pendapatan pada periode ini.</div>
      @endif
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