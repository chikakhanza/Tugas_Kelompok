<div class="mb-3">
    <label>Kode</label>
    <input type="text" name="kode" class="form-control" value="{{ old('kode', $homestay->kode ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Tipe Kamar</label>
    <input type="text" name="tipe_kamar" class="form-control" value="{{ old('tipe_kamar', $homestay->tipe_kamar ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Harga Sewa per Hari</label>
    <input type="number" name="harga_sewa_per_hari" class="form-control" value="{{ old('harga_sewa_per_hari', $homestay->harga_sewa_per_hari ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Lama Inap</label>
    <input type="number" name="lama_inap" class="form-control" value="{{ old('lama_inap', $homestay->lama_inap ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Total Bayar</label>
    <input type="number" name="total_bayar" class="form-control" value="{{ old('total_bayar', $homestay->total_bayar ?? '') }}" required>
</div>
