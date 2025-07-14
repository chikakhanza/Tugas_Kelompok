<div class="card shadow-lg border-0 rounded-4 p-4">
    <h4 class="mb-4 text-primary fw-bold">
        <i class="bi bi-credit-card-2-back-fill me-2"></i> Form Pembayaran
    </h4>

    <!-- Booking -->
    <div class="mb-3">
        <label for="booking_id" class="form-label">
            <i class="bi bi-person-check me-1"></i> Booking
        </label>
        <select name="booking_id" id="booking_id" class="form-select" required>
            <option value="">-- Pilih Booking --</option>
            @foreach($bookings as $booking)
                <option value="{{ $booking->id }}"
                    data-total="{{ $booking->total_bayar }}"
                    {{ old('booking_id', $payment->booking_id ?? '') == $booking->id ? 'selected' : '' }}>
                    {{ optional($booking->user)->name ?? 'User Tidak Ditemukan' }} - Rp{{ number_format($booking->total_bayar, 0, ',', '.') }}
                </option>
            @endforeach
        </select>
        <div class="form-text">Pilih user dan total tagihannya</div>
    </div>

    <!-- Metode Pembayaran -->
    <div class="mb-3">
        <label for="metode_pembayaran" class="form-label">
            <i class="bi bi-wallet2 me-1"></i> Metode Pembayaran
        </label>
        <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
            <option value="">-- Pilih Metode --</option>
            <option value="qris" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'qris' ? 'selected' : '' }}>QRIS</option>
            <option value="transfer" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'transfer' ? 'selected' : '' }}>Transfer</option>
            <option value="tunai" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'tunai' ? 'selected' : '' }}>Tunai</option>
        </select>
    </div>

    <!-- Tanggal Pembayaran -->
    <div class="mb-3">
        <label for="tanggal_pembayaran" class="form-label">
            <i class="bi bi-calendar-check me-1"></i> Tanggal Pembayaran
        </label>
        <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control"
            value="{{ old('tanggal_pembayaran', $payment->tanggal_pembayaran ?? '') }}" required>
    </div>

    <!-- Jumlah Dibayar -->
    <div class="mb-3">
        <label for="jumlah_dibayar" class="form-label">
            <i class="bi bi-cash-coin me-1"></i> Jumlah Dibayar (Rp)
        </label>
        <input type="number" name="jumlah_dibayar" id="jumlah_dibayar" class="form-control bg-light"
            value="{{ old('jumlah_dibayar', $payment->jumlah_dibayar ?? '') }}" min="0" required readonly>
    </div>

    <div class="d-grid mt-4">
        <button type="submit" class="btn btn-success btn-lg rounded-3 shadow-sm">
            <i class="bi bi-save me-1"></i> Simpan Pembayaran
        </button>
    </div>
</div>

<!-- SCRIPT untuk otomatis jumlah dibayar -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookingSelect = document.getElementById('booking_id');
        const jumlahDibayarInput = document.getElementById('jumlah_dibayar');

        function setJumlahDibayar() {
            const selectedOption = bookingSelect.options[bookingSelect.selectedIndex];
            const total = selectedOption.getAttribute('data-total');
            jumlahDibayarInput.value = total ? total : '';
        }

        // Saat pertama load (jika edit form)
        setJumlahDibayar();

        // Saat select berubah
        bookingSelect.addEventListener('change', setJumlahDibayar);
    });
</script>
