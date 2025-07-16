<div class="card shadow-lg border-0 rounded-4">

  {{-- ===== HEADER GRADASI PINK ===== --}}
  <div class="card-header py-3"
       style="background:linear-gradient(90deg,#ff9aa2,#ffb6c1);">
    <h4 class="mb-0 text-white fw-bold">
      <i class="bi bi-credit-card-2-back-fill me-2"></i> Form Pembayaran
    </h4>
  </div>

  <div class="card-body p-4 bg-soft-pink">

    {{-- === BOOKING === --}}
    <div class="mb-3">
      <label class="form-label">
        <i class="bi bi-person-check me-1"></i> Booking
      </label>
      <select name="booking_id" id="booking_id"
              class="form-select" required>
        <option value="">-- Pilih Booking --</option>
        @foreach($bookings as $b)
          <option value="{{ $b->id }}" data-total="{{ $b->total_bayar }}"
            {{ old('booking_id',$payment->booking_id??'')==$b->id?'selected':'' }}>
            {{ optional($b->user)->name ?? 'User ?' }} - Rp{{ number_format($b->total_bayar,0,',','.') }}
          </option>
        @endforeach
      </select>
      <div class="form-text">Pilih user & total tagihan</div>
    </div>

    {{-- === METODE === --}}
    <div class="mb-3">
      <label class="form-label">
        <i class="bi bi-wallet2 me-1"></i> Metode Pembayaran
      </label>
      <select name="metode_pembayaran" id="metode_pembayaran"
              class="form-select" required>
        <option value="">-- Pilih Metode --</option>
        @foreach(['qris','transfer','tunai'] as $m)
          <option value="{{ $m }}"
            {{ old('metode_pembayaran',$payment->metode_pembayaran??'')==$m?'selected':'' }}>
            {{ ucfirst($m) }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- === TANGGAL === --}}
    <div class="mb-3">
      <label class="form-label">
        <i class="bi bi-calendar-check me-1"></i> Tanggal Pembayaran
      </label>
      <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran"
             class="form-control"
             value="{{ old('tanggal_pembayaran',$payment->tanggal_pembayaran??'') }}" required>
    </div>

    {{-- === JUMLAH === --}}
    <div class="mb-3">
      <label class="form-label">
        <i class="bi bi-cash-coin me-1"></i> Jumlah Dibayar (Rp)
      </label>
      <input type="number" name="jumlah_dibayar" id="jumlah_dibayar"
             class="form-control bg-light"
             value="{{ old('jumlah_dibayar',$payment->jumlah_dibayar??'') }}"
             readonly required>
    </div>

    {{-- === BUTTON === --}}
    <div class="d-grid mt-4">
      <button type="submit" class="btn btn-pink btn-lg rounded-pill">
        💾 Simpan Pembayaran
      </button>
    </div>
  </div>
</div>

{{-- ===== CSS PINK ===== --}}
@push('styles')
<style>
  .bg-soft-pink {background:#fff5fa;}
  .btn-pink     {background:#f78fb3;color:#fff;border:none;}
  .btn-pink:hover{background:#d63384;color:#fff;}
</style>
@endpush

{{-- ===== SCRIPT: autofill jumlah dibayar ===== --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',()=>{
  const sel=document.getElementById('booking_id');
  const amt=document.getElementById('jumlah_dibayar');
  function setAmt(){
    const opt=sel.options[sel.selectedIndex];
    amt.value=opt.getAttribute('data-total')||'';
  }
  sel.addEventListener('change',setAmt);
  setAmt();
});
</script>
