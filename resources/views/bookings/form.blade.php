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

<div class="form-group mb-3">
    <label for="check_in">Check In</label>
    <input type="date" name="check_in" id="check_in" class="form-control" value="{{ old('check_in', $booking->check_in ?? '') }}" required>
</div>

<div class="form-group mb-3">
    <label for="check_out">Check Out</label>
    <input type="date" name="check_out" id="check_out" class="form-control" value="{{ old('check_out', $booking->check_out ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="jumlah_kamar">Jumlah Kamar</label>
    <input type="number" name="jumlah_kamar" id="jumlah_kamar" class="form-control" value="{{ old('jumlah_kamar', $booking->jumlah_kamar ?? 1) }}" min="1" required>
    <div id="kamar_alert" class="text-danger" style="display:none;">Jumlah kamar tidak tersedia!</div>
</div>

<div class="mb-3">
    <label for="total_hari">Total Hari</label>
    <input type="number" name="total_hari" id="total_hari" class="form-control" value="{{ old('total_hari', $booking->total_hari ?? '') }}" readonly>
</div>

<div class="mb-3">
    <label for="keterlambatan">Keterlambatan (hari)</label>
    <input type="number" name="keterlambatan" id="keterlambatan" class="form-control" value="{{ old('keterlambatan', $booking->keterlambatan ?? 0) }}" min="0">
</div>

<div class="mb-3">
    <label for="denda">Denda</label>
    <input type="number" name="denda" id="denda" class="form-control" value="{{ old('denda', $booking->denda ?? 0) }}" readonly>
</div>

<div class="mb-3">
    <label for="total_bayar">Total Bayar</label>
    <input type="number" name="total_bayar" id="total_bayar" class="form-control" value="{{ old('total_bayar', $booking->total_bayar ?? '') }}" readonly>
</div>

<div class="mb-3">
    <label for="catatan">Catatan</label>
    <textarea name="catatan" id="catatan" class="form-control">{{ old('catatan', $booking->catatan ?? '') }}</textarea>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const homestaySelect = document.getElementById('homestay_id');
    const jumlahKamarInput = document.getElementById('jumlah_kamar');
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const totalHariInput = document.getElementById('total_hari');
    const keterlambatanInput = document.getElementById('keterlambatan');
    const dendaInput = document.getElementById('denda');
    const totalBayarInput = document.getElementById('total_bayar');
    const kamarAlert = document.getElementById('kamar_alert');

    // Data homestay dari blade ke JS
    const homestayData = @json($homestays->keyBy('id'));

    function getMaxKamar() {
        const homestayId = homestaySelect.value;
        return homestayId && homestayData[homestayId] ? parseInt(homestayData[homestayId].jumlah_kamar) : 0;
    }

    function updateJumlahKamar() {
        const maxKamar = getMaxKamar();
        let jumlah = parseInt(jumlahKamarInput.value) || 1;
        if (jumlah > maxKamar && maxKamar > 0) {
            jumlahKamarInput.value = maxKamar;
            kamarAlert.style.display = '';
        } else {
            kamarAlert.style.display = 'none';
        }
    }

    function updateTotalHari() {
        const checkIn = checkInInput.value;
        const checkOut = checkOutInput.value;
        if (checkIn && checkOut && checkOut > checkIn) {
            const date1 = new Date(checkIn);
            const date2 = new Date(checkOut);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            totalHariInput.value = diffDays;
        } else {
            totalHariInput.value = '';
        }
    }

    function updateTotalBayarDanDenda() {
        const homestayId = homestaySelect.value;
        const totalHari = parseInt(totalHariInput.value) || 0;
        const jumlahKamar = parseInt(jumlahKamarInput.value) || 0;
        const keterlambatan = parseInt(keterlambatanInput.value) || 0;
        let harga = 0;
        if (homestayId && homestayData[homestayId]) {
            harga = parseInt(homestayData[homestayId].harga_sewa_per_hari) || 0;
        }
        // Total bayar sudah termasuk denda
        let totalBayar = harga * totalHari * jumlahKamar;
        let denda = 0;
        if (keterlambatan > 0) {
            denda = Math.round(totalBayar * 0.1 * keterlambatan);
        }
        totalBayar += denda;
        dendaInput.value = denda;
        totalBayarInput.value = totalBayar;
    }

    homestaySelect.addEventListener('change', function() {
        updateJumlahKamar();
        updateTotalBayarDanDenda();
    });
    jumlahKamarInput.addEventListener('input', function() {
        updateJumlahKamar();
        updateTotalBayarDanDenda();
    });
    checkInInput.addEventListener('change', function() {
        updateTotalHari();
        updateTotalBayarDanDenda();
    });
    checkOutInput.addEventListener('change', function() {
        updateTotalHari();
        updateTotalBayarDanDenda();
    });
    keterlambatanInput.addEventListener('input', updateTotalBayarDanDenda);

    // Set awal
    updateJumlahKamar();
    updateTotalHari();
    updateTotalBayarDanDenda();
});
</script>
