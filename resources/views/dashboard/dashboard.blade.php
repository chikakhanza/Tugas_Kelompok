@extends('layouts.main')

@section('content')
<div class="homestay-bg py-5 px-4">
    <!-- Heading -->
    <div class="container-xxl text-center mb-5">
        <h2 class="fw-bold text-gradient display-5">✨ Sekilas Tentang Homestay</h2>
        <p class="text-muted fs-5">Rasakan pengalaman menginap terbaik dengan suasana nyaman, bersih, dan penuh kehangatan seperti rumah sendiri.</p>
    </div>

    <!-- Beranda -->
    <div class="container-xxl mb-5">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/illustrations/homepage.png') }}" alt="Beranda Homestay" class="img-fluid rounded zoom shadow">
            </div>
            <div class="col-lg-6">
                <h4 class="text-pink fw-semibold mb-3 fs-4">🏠 Beranda Homestay</h4>
                <p class="fs-6 text-dark">Kami menghadirkan penginapan bernuansa keluarga yang bersih dan nyaman. Lokasi kami strategis, dekat dengan pusat kota dan objek wisata, menjadikan homestay kami pilihan ideal untuk keluarga dan pelancong.</p>
            </div>
        </div>
    </div>

    <!-- Sejarah -->
    <div class="container-xxl mb-5">
        <div class="row align-items-center gy-4 flex-lg-row-reverse">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/illustrations/history.png') }}" alt="Sejarah Homestay" class="img-fluid rounded zoom shadow">
            </div>
            <div class="col-lg-6">
                <h4 class="text-pink fw-semibold mb-3 fs-4">📜 Sejarah Kami</h4>
                <p class="fs-6 text-dark">Sejak tahun 2015, kami memulai perjalanan sebagai penginapan keluarga kecil. Dengan dedikasi dan kepercayaan pelanggan, kami berkembang menjadi homestay pilihan di kota ini dengan pelayanan yang ramah dan fasilitas modern.</p>
            </div>
        </div>
    </div>

    <!-- Galeri Kamar -->
    <div class="container-xxl text-center mb-4">
        <h4 class="text-pink fw-semibold fs-4">🛏️ Galeri Kamar</h4>
        <p class="text-muted fs-6">Beberapa pilihan kamar unggulan kami dengan fasilitas lengkap dan suasana nyaman:</p>
    </div>

    <div class="container-xxl">
        <div class="row g-4">
            @php
                $kamars = [
                    ['file' => 'standar.jpg', 'title' => 'Kamar Standard'],
                    ['file' => 'room2.jpg', 'title' => 'Kamar Deluxe'],
                    ['file' => 'room3.jpg', 'title' => 'Kamar suite'],
                ];
            @endphp

            @foreach($kamars as $kamar)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 zoom-hover rounded-4">
                        <img src="{{ asset('assets/img/kamar/' . $kamar['file']) }}" class="card-img-top rounded-top" alt="{{ $kamar['title'] }}">
                        <div class="card-body text-center py-3">
                            <h6 class="mb-1 text-pink fs-5">{{ $kamar['title'] }}</h6>
                            <small class="text-muted">Fasilitas lengkap & nyaman</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    /* Latar gradasi penuh */
    .homestay-bg {
        background: linear-gradient(to bottom, #fff0f6, #ffe4f1, #fce7f3, #fde0e7);
        min-height: 100vh;
    }

    .text-pink {
        color: #db2777;
    }

    .text-gradient {
        background: linear-gradient(to right, #ec4899, #f472b6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .zoom, .zoom-hover {
        transition: transform 0.3s ease-in-out;
    }

    .zoom:hover, .zoom-hover:hover {
        transform: scale(1.03);
    }

    .card {
        background-color: #fff;
        border-radius: 16px;
    }
</style>
@endsection
