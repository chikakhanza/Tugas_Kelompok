<div class="card shadow-lg rounded-4 p-4">
    <h4 class="mb-4"><i class="bi bi-house-door-fill"></i> Formulir Homestay</h4>

    <div class="mb-3">
        <label class="form-label">Kode</label>
        <input type="text" name="kode" class="form-control" value="{{ old('kode', $homestay->kode ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipe Kamar</label>
        <select name="tipe_kamar" id="tipe_kamar" class="form-select" required>
            <option value="">-- Pilih Tipe Kamar --</option>
            <option value="Standard" {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == 'Standard' ? 'selected' : '' }}>Standard</option>
            <option value="Deluxe" {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
            <option value="Suite" {{ old('tipe_kamar', $homestay->tipe_kamar ?? '') == 'Suite' ? 'selected' : '' }}>Suite</option>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Harga Sewa per Hari (Rp)</label>
            <input type="number" name="harga_sewa_per_hari" id="harga_sewa_per_hari" class="form-control" value="{{ old('harga_sewa_per_hari', $homestay->harga_sewa_per_hari ?? '') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Lama Inap (Hari)</label>
            <input type="number" name="lama_inap" id="lama_inap" class="form-control" value="{{ old('lama_inap', $homestay->lama_inap ?? '') }}" min="1" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Fasilitas</label>
        <input type="text" name="fasilitas" id="fasilitas" class="form-control" value="{{ old('fasilitas', $homestay->fasilitas ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Jumlah Kamar</label>
        <input type="number" name="jumlah_kamar" class="form-control" value="{{ old('jumlah_kamar', $homestay->jumlah_kamar ?? 1) }}" min="1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Total Bayar (Rp)</label>
        <input type="number" name="total_bayar" id="total_bayar" class="form-control bg-light" readonly value="{{ old('total_bayar', $homestay->total_bayar ?? '') }}">
    </div>

    <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary btn-lg rounded-3"><i class="bi bi-save"></i> Simpan</button>
    </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fasilitasMap = {
        'Standard': 'Kipas Angin, TV',
        'Deluxe': 'AC, TV, Air Panas',
        'Suite': 'AC, TV, Air Panas, Mini Bar, Bathtub'
    };

    function setFasilitas() {
        const tipe = document.getElementById('tipe_kamar').value;
        document.getElementById('fasilitas').value = fasilitasMap[tipe] || '';
    }

    function hitungTotal() {
        let harga = parseFloat(document.getElementById('harga_sewa_per_hari').value) || 0;
        let lama = parseInt(document.getElementById('lama_inap').value) || 0;
        document.getElementById('total_bayar').value = harga * lama;
    }

    document.getElementById('tipe_kamar').addEventListener('change', setFasilitas);
    document.getElementById('harga_sewa_per_hari').addEventListener('input', hitungTotal);
    document.getElementById('lama_inap').addEventListener('input', hitungTotal);

    setFasilitas();
    hitungTotal();
});
</script>
