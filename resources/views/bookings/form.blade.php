<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Booking Homestay</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ==== Tema Pink Lembut ==== */
    .gradient-header{
      background:linear-gradient(90deg,#f78fb3,#f8a5c2);color:#fff;
    }
    .btn-pink     {background:#f78fb3;color:#fff;border:none;}
    .btn-pink:hover{background:#d63384;color:#fff;}
    .bg-soft-pink {background:#fff5fa;}
  </style>
</head>
<body class="bg-soft-pink">

<div class="container mt-4">
  <div class="card shadow rounded-4 border-0">
    <!-- HEADER -->
    <div class="card-header gradient-header text-center fw-bold">
      <h5 class="mb-0"><i class="bi bi-calendar-heart me-1"></i> Form Booking Homestay</h5>
    </div>

    <div class="card-body p-4">
      <!-- FORM START -->
      <form action="{{ isset($booking) ? route('bookings.update',$booking->id) : route('bookings.store') }}" method="POST">
        @csrf @isset($booking) @method('PUT') @endisset

        <!-- USER -->
        <div class="mb-3">
          <label class="form-label">User</label>
          <select name="user_id" id="user_id" class="form-select" required>
            <option value="">-- Pilih User --</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}"
                {{ old('user_id',$booking->user_id??'')==$user->id?'selected':'' }}>
                {{ $user->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- HOMESTAY -->
        <div class="mb-3">
          <label class="form-label">Homestay</label>
          <select name="homestay_id" id="homestay_id" class="form-select" required>
            <option value="">-- Pilih Homestay --</option>
            @foreach($homestays as $h)
              <option value="{{ $h->id }}"
                {{ old('homestay_id',$booking->homestay_id??'')==$h->id?'selected':'' }}>
                {{ $h->kode }} - {{ $h->tipe_kamar }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- TANGGAL -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Check‑in</label>
            <input type="date" name="check_in" id="check_in"
                   class="form-control"
                   value="{{ old('check_in',$booking->check_in??'') }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Check‑out</label>
            <input type="date" name="check_out" id="check_out"
                   class="form-control"
                   value="{{ old('check_out',$booking->check_out??'') }}" required>
          </div>
        </div>

        <!-- JUMLAH & TOTAL -->
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Jumlah Kamar</label>
            <input type="number" name="jumlah_kamar" id="jumlah_kamar"
                   min="1" class="form-control"
                   value="{{ old('jumlah_kamar',$booking->jumlah_kamar??1) }}" required>
            <small id="kamar_alert" class="text-danger d-none">Jumlah kamar tidak tersedia!</small>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Total Hari</label>
            <input type="number" name="total_hari" id="total_hari"
                   class="form-control" value="{{ old('total_hari',$booking->total_hari??'') }}" readonly>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Keterlambatan (hari)</label>
            <input type="number" name="keterlambatan" id="keterlambatan"
                   min="0" class="form-control"
                   value="{{ old('keterlambatan',$booking->keterlambatan??0) }}">
          </div>
        </div>

        <!-- DENDA & TOTAL BAYAR -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Denda</label>
            <input type="number" name="denda" id="denda"
                   class="form-control" value="{{ old('denda',$booking->denda??0) }}" readonly>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Total Bayar</label>
            <input type="number" name="total_bayar" id="total_bayar"
                   class="form-control" value="{{ old('total_bayar',$booking->total_bayar??'') }}" readonly>
          </div>
        </div>

        <!-- CATATAN -->
        <div class="mb-3">
          <label class="form-label">Catatan</label>
          <textarea name="catatan" id="catatan" rows="3"
                    class="form-control">{{ old('catatan',$booking->catatan??'') }}</textarea>
        </div>

        <!-- BUTTON -->
        <div class="d-grid">
          <button type="submit" class="btn btn-pink btn-lg rounded-pill">
            💾 Simpan Booking
          </button>
        </div>
      </form>
      <!-- FORM END -->
    </div>
  </div>
</div>

<!-- DATA JSON HOMESTAY UNTUK JS -->
<script type="application/json" id="homestay-data">
{!! $homestays->keyBy('id')->toJson() !!}
</script>

<!-- LOGIC JS -->
<script>
document.addEventListener('DOMContentLoaded',()=>{
  const homestays = JSON.parse(document.getElementById('homestay-data').textContent);
  const homestaySel=id('homestay_id'),kamar=id('jumlah_kamar'),
        inD=id('check_in'),outD=id('check_out'),hari=id('total_hari'),
        telat=id('keterlambatan'),denda=id('denda'),total=id('total_bayar'),
        alert=id('kamar_alert');
  function id(e){return document.getElementById(e)}
  function maxKamar(){return homestays[homestaySel.value]?.jumlah_kamar||0}
  function cekKamar(){
    let val=parseInt(kamar.value)||1,m=maxKamar();
    if(m&&val>m){kamar.value=m;alert.classList.remove('d-none');}
    else alert.classList.add('d-none');
  }
  function hitungHari(){
    if(inD.value&&outD.value&&outD.value>inD.value){
      const diff=(new Date(outD.value)-new Date(inD.value))/(1000*60*60*24);
      hari.value=Math.ceil(diff);
    }else hari.value='';
  }
  function hitungTotal(){
    const h=homestays[homestaySel.value]||{},
          harga=parseInt(h.harga_sewa_per_hari)||0,
          j=parseInt(kamar.value)||0, dHari=parseInt(hari.value)||0,
          terl=parseInt(telat.value)||0;
    let tot=harga*j*dHari, dn=0;
    if(terl>0) dn=Math.round(tot*0.1*terl);
    tot+=dn; denda.value=dn; total.value=tot;
  }
  [homestaySel,kamar,inD,outD,telat].forEach(el=>el.addEventListener('input',()=>{
    cekKamar();hitungHari();hitungTotal();
  }));
  cekKamar();hitungHari();hitungTotal();
});
</script>
</body>
</html>
