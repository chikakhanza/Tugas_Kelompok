<div class="mb-3">
    <label>Kode</label>
    <input type="text" name="kode" class="form-control" value="{{ old('kode', $homestay->kode ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Tipe Kamar</label>
    <select name="tipe_kamar" id="tipe_kamar" class="form-control" required>
        <option value="">-- Pilih Tipe Kamar --</option>
        <option value="Standard" {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == 'Standard' ? 'selected' : '' }}>Standard</option>
        <option value="Deluxe" {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
        <option value="Suite" {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == 'Suite' ? 'selected' : '' }}>Suite</option>
    </select>
</div>
<div class="mb-3">
    <label>Harga Sewa per Hari</label>
    <input type="number" name="harga_sewa_per_hari" id="harga_sewa_per_hari" class="form-control" value="{{ old('harga_sewa_per_hari', $homestay->harga_sewa_per_hari ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Lama Inap</label>
    <input type="number" name="lama_inap" id="lama_inap" class="form-control" value="{{ old('lama_inap', $homestay->lama_inap ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Total Bayar</label>
    <input type="number" name="total_bayar" id="total_bayar" class="form-control" value="{{ old('total_bayar', $homestay->total_bayar ?? '') }}" readonly>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function hitungTotal() {
        let harga = parseFloat(document.getElementById('harga_sewa_per_hari').value) || 0;
        let lama = parseInt(document.getElementById('lama_inap').value) || 0;
        document.getElementById('total_bayar').value = harga * lama;
    }
    document.getElementById('harga_sewa_per_hari').addEventListener('input', hitungTotal);
    document.getElementById('lama_inap').addEventListener('input', hitungTotal);
});
</script>