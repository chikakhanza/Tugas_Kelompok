{{-- ======= FORM START ======= --}}
<div class="card shadow rounded-4 border-0 mb-4" style="max-width: 520px; background: #ffe6ec;">
  <div class="card-header text-white fw-bold text-center" style="background: linear-gradient(90deg, #ff9aa2, #ffb7c5);">
    💖 Form Pengguna
  </div>

  <div class="card-body p-4">

    {{-- ==== Nama ==== --}}
    <div class="mb-3">
      <label class="form-label fw-semibold text-pink">Nama</label>
      <div class="input-group">
        <span class="input-group-text bg-white text-pink"><i class="fas fa-user"></i></span>
        <input type="text"
               name="name"
               class="form-control border-pink @error('name') is-invalid @enderror"
               placeholder="Nama lengkap"
               value="{{ old('name', $user->name ?? '') }}"
               required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    {{-- ==== Email ==== --}}
    <div class="mb-3">
      <label class="form-label fw-semibold text-pink">Email</label>
      <div class="input-group">
        <span class="input-group-text bg-white text-pink"><i class="fas fa-envelope"></i></span>
        <input type="email"
               name="email"
               class="form-control border-pink @error('email') is-invalid @enderror"
               placeholder="nama@email.com"
               value="{{ old('email', $user->email ?? '') }}"
               required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    {{-- ==== Password ==== --}}
    <div class="mb-3">
      <label class="form-label fw-semibold text-pink">
        Password
        @isset($user)
          <span class="text-muted small">(opsional)</span>
        @endisset
      </label>
      <div class="input-group">
        <span class="input-group-text bg-white text-pink"><i class="fas fa-lock"></i></span>
        <input type="password"
               name="password"
               class="form-control border-pink @error('password') is-invalid @enderror"
               {{ isset($user) ? '' : 'required' }}
               placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Minimal 6 karakter' }}">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      @isset($user)
        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
      @endisset
    </div>

    {{-- ==== Tombol Aksi ==== --}}
    <div class="d-flex justify-content-between mt-4">
      <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        ← Batal
      </a>
      <button type="submit" class="btn text-white rounded-pill px-4" style="background: #ff7fa0;">
        💾 Simpan
      </button>
    </div>
  </div>
</div>

{{-- ==== Tambahan CSS Pink ==== --}}
@push('styles')
<style>
  .text-pink {
    color: #d63384;
  }
  .border-pink {
    border-color: #ffb6c1;
  }
</style>
@endpush
