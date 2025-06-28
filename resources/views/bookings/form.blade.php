<!-- User -->
<div class="mb-3">
    <label for="user_id">User</label>
    <select name="user_id" id="user_id" class="form-control" required>
        <option value="">-- Pilih User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $booking->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Homestay -->
<div class="mb-3">
    <label for="homestay_id">Homestay</label>
    <select name="homestay_id" id="homestay_id" class="form-control" required>
        <option value="">-- Pilih Homestay --</option>
        @foreach($homestays as $homestay)
            <option value="{{ $homestay->id }}" {{ old('homestay_id', $booking->homestay_id ?? '') == $homestay->id ? 'selected' : '' }}>
                {{ $homestay->kode }} - {{ $homestay->tipe_kamar }}
            </option>
        @endforeach
    </select>
</div>

<!-- Check In -->
<div class="form-group mb-3">
    <label for="check_in">Check In</label>
    <input type="date" name="check_in" id="check_in" class="form-control" value="{{ old('check_in', $booking->check_in ?? '') }}" required>
</div>

<!-- Check Out -->
<div class="form-group mb-3">
    <label for="check_out">Check Out</label>
    <input type="date" name="check_out" id="check_out" class="form-control" value="{{ old('check_out', $booking->check_out ?? '') }}" required>
</div>

<!-- Input Status (hidden untuk dikirim) -->
<input type="hidden" name="status" id="status" value="{{ old('status', $booking->status ?? 'pending') }}">

<!-- Display Status (terlihat tapi tidak bisa diedit) -->
<div class="form-group mb-3">
    <label>Status</label>
    <input type="text" id="status_display" class="form-control" value="{{ old('status', $booking->status ?? 'pending') }}" readonly>
</div>


<!-- Script untuk logika status -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homestaySelect = document.getElementById('homestay_id');
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');
        const statusInput = document.getElementById('status');
        const statusDisplay = document.getElementById('status_display');

        function updateStatus() {
            const homestay = homestaySelect.value;
            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;

            let status = 'pending';
            if (homestay && checkIn && checkOut) {
                status = 'confirmed';
            }

            statusInput.value = status;
            statusDisplay.value = status;
        }

        homestaySelect.addEventListener('change', updateStatus);
        checkInInput.addEventListener('change', updateStatus);
        checkOutInput.addEventListener('change', updateStatus);

        updateStatus(); // Set awal
    });
</script>
