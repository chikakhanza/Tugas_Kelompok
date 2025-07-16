@extends('layouts.main')

@section('content')
<div class="container py-4">
  <form action="{{ isset($homestay) ? route('homestays.update', $homestay->id) : route('homestays.store') }}"
        method="POST"
        class="mx-auto" style="max-width:560px;">
    @csrf
    @isset($homestay) @method('PUT') @endisset

    <div class="card shadow-lg rounded-4 border-0" style="background-color: #fff0f5;">
      {{-- ===== HEADER ===== --}}
      <div class="card-header text-white text-center fw-bold"
           style="background: linear-gradient(90deg, #f78fb3, #f8a5c2);">
        <i class="bi bi-house-heart-fill me-1"></i>
        {{ isset($homestay) ? 'Edit' : 'Tambah' }} Homestay
      </div>

      <div class="card-body p-4">

        {{-- ------ KODE ------ --}}
        <div class="mb-3">
          <label class="form-label">Kode</label>
          <div class="input-group">
            <span class="input-group-text bg-white text-pink"><i class="bi bi-tag-fill"></i></span>
            <input type="text" name="kode"
                   class="form-control @error('kode') is-invalid @enderror"
                   value="{{ old('kode', $homestay->kode ?? '') }}"
                   required>
            @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        {{-- ------ TIPE KAMAR ------ --}}
        <div class="mb-3">
          <label class="form-label">Tipe Kamar</label>
          <div class="input-group">
            <span class="input-group-text bg-white text-pink"><i class="bi bi-door-closed-fill"></i></span>
            <select name="tipe_kamar" id="tipe_kamar"
                    class="form-select @error('tipe_kamar') is-invalid @enderror"
                    required>
              <option value="">-- Pilih Tipe --</option>
              @foreach(['Standard','Deluxe','Suite'] as $tipe)
                <option value="{{ $tipe }}"
                  {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == $tipe ? 'selected' : '' }}>
                  {{ $tipe }}
                </option>
              @endforeach
            </select>
            @error('tipe_kamar') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        {{-- ------ HARGA & JUMLAH ------ --}}
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Harga Sewa / Hari (Rp)</label>
            <div class="input-group">
              <span class="input-group-text bg-white text-pink"><i class="bi bi-cash"></i></span>
              <input type="number"
                     name="harga_sewa_per_hari"
                     id="harga_sewa_per_hari"
                     class="form-control @error('harga_sewa_per_hari') is-invalid @enderror"
                     value="{{ old('harga_sewa_per_hari', $homestay->harga_sewa_per_hari ?? '') }}"
                     required>
              @error('harga_sewa_per_hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah Kamar</label>
            <div class="input-group">
              <span class="input-group-text bg-white text-pink"><i class="bi bi-123"></i></span>
              <input type="number"
                     name="jumlah_kamar"
                     min="1"
                     class="form-control @error('jumlah_kamar') is-invalid @enderror"
                     value="{{ old('jumlah_kamar', $homestay->jumlah_kamar ?? 1) }}"
                     required>
              @error('jumlah_kamar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>
        </div>

        {{-- ------ FASILITAS ------ --}}
        <div class="mb-3">
          <label class="form-label">Fasilitas</label>
          <div class="input-group">
            <span class="input-group-text bg-white text-pink"><i class="bi bi-stars"></i></span>
            <input type="text"
                   name="fasilitas"
                   id="fasilitas"
                   class="form-control @error('fasilitas') is-invalid @enderror"
                   value="{{ old('fasilitas', $homestay->fasilitas ?? '') }}">
            @error('fasilitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
          <small class="text-muted">Terisi otomatis berdasarkan tipe kamar.</small>
        </div>

        {{-- ------ BUTTON SUBMIT ------ --}}
        <div class="d-grid mt-4">
          <button type="submit" class="btn text-white btn-lg rounded-pill"
                  style="background-color: #f78fb3;">
            <i class="bi bi-save"></i> Simpan
          </button>
        </div>

      </div>
    </div>
  </form>
</div>

{{-- ===== Script Auto-Fill Fasilitas ===== --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const map = {
    Standard : 'Kipas Angin, TV',
    Deluxe   : 'AC, TV, Air Panas',
    Suite    : 'AC, TV, Air Panas, Mini Bar, Bathtub'
  };
  const tipe = document.getElementById('tipe_kamar');
  const fasilitas = document.getElementById('fasilitas');

  function updateFasilitas() {
    fasilitas.value = map[tipe.value] || '';
  }

  tipe.addEventListener('change', updateFasilitas);
  updateFasilitas();
});
</script>
@endpush
@endsection
