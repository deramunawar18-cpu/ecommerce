{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    /* Hero Section Styles */
    .hero-distro {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        position: relative;
        overflow: hidden;
        min-height: 600px;
    }

    .hero-distro::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.03) 35px, rgba(255,255,255,.03) 70px);
        opacity: 0.5;
    }

    .hero-distro::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(230, 126, 34, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-block;
        background: linear-gradient(135deg, #e67e22, #d35400);
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1.2;
        text-shadow: 2px 4px 8px rgba(0,0,0,0.3);
        margin-bottom: 24px;
    }

    .hero-title .highlight {
        background: linear-gradient(135deg, #e67e22, #f39c12);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.25rem;
        opacity: 0.9;
        line-height: 1.8;
        margin-bottom: 32px;
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, #e67e22, #d35400);
        border: none;
        padding: 16px 40px;
        font-size: 18px;
        font-weight: 700;
        border-radius: 50px;
        box-shadow: 0 6px 20px rgba(230, 126, 34, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(230, 126, 34, 0.6);
        background: linear-gradient(135deg, #d35400, #e67e22);
    }

    .btn-hero-outline {
        background: transparent;
        border: 2px solid rgba(255,255,255,0.3);
        color: white;
        padding: 16px 40px;
        font-size: 18px;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(10px);
    }

    .btn-hero-outline:hover {
        border-color: #e67e22;
        background: rgba(230, 126, 34, 0.1);
        color: white;
        transform: translateY(-3px);
    }

    .hero-stats {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .stat-item h3 {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #e67e22, #f39c12);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
    }

    .stat-item p {
        font-size: 0.95rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Hero Image */
    .hero-image-wrapper {
        position: relative;
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(-3deg); }
        50% { transform: translateY(-30px) rotate(3deg); }
    }

    .hero-image-wrapper::before {
        content: '';
        position: absolute;
        top: -30px;
        left: -30px;
        right: -30px;
        bottom: -30px;
        background: radial-gradient(circle, rgba(230, 126, 34, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }

    .hero-image-wrapper img {
        filter: drop-shadow(0 20px 40px rgba(0,0,0,0.5));
        border-radius: 20px;
    }

    .badge-discount {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 24px;
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.6);
        animation: rotate 10s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .badge-new {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #27ae60, #229954);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 15px rgba(39, 174, 96, 0.5);
    }

    /* Section Titles */
    .section-title {
        font-size: 2.5rem;
        font-weight: 900;
        color: #1a1a2e;
        margin-bottom: 16px;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #e67e22, #f39c12);
        border-radius: 2px;
    }

    .section-subtitle {
        color: #7f8c8d;
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    /* Category Cards */
    .category-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        border-radius: 20px;
        overflow: hidden;
        background: white;
    }

    .category-card:hover {
        transform: translateY(-15px) scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    }

    .category-card .card-body {
        padding: 32px 20px;
    }

    .category-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 50%;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .category-card:hover .category-image-wrapper {
        transform: scale(1.15) rotate(5deg);
    }

    .category-image-wrapper img {
        border: 4px solid #f8f9fa;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .category-name {
        font-size: 1rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .category-count {
        color: #95a5a6;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Promo Banners */
    .promo-card {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        min-height: 280px;
        border: none;
        transition: transform 0.3s ease;
    }

    .promo-card:hover {
        transform: scale(1.02);
    }

    .promo-card-flash {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    }

    .promo-card-member {
        background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    }

    .promo-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 100px;
        opacity: 0.15;
    }

    .promo-card h3 {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .promo-card p {
        font-size: 1.15rem;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .btn-promo {
        padding: 14px 32px;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-promo:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    /* Newsletter Section */
    .newsletter-section {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        position: relative;
        overflow: hidden;
    }

    .newsletter-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(230, 126, 34, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .newsletter-title {
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .newsletter-input {
        border: none;
        padding: 18px 28px;
        font-size: 16px;
        border-radius: 50px 0 0 50px;
    }

    .newsletter-input:focus {
        box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.2);
    }

    .newsletter-btn {
        background: linear-gradient(135deg, #e67e22, #d35400);
        border: none;
        padding: 18px 40px;
        border-radius: 0 50px 50px 0;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
        background: linear-gradient(135deg, #d35400, #e67e22);
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .hero-title {
            font-size: 2.5rem;
        }
        .hero-stats {
            margin-top: 40px;
            padding-top: 30px;
        }
    }

    @media (max-width: 767px) {
        .hero-title {
            font-size: 2rem;
        }
        .section-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
    {{-- Hero Section - Distro Theme --}}
    <section class="hero-distro text-white py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="bi bi-star-fill me-2"></i>Original Distro Indonesia
                        </div>
                        <h1 class="hero-title">
                            Toko Kaos Distro<br>
                            <span class="highlight">Terbaik</span> di Indonesia
                        </h1>
                        <p class="hero-description">
                            Temukan koleksi kaos distro original dengan desain eksklusif dan kualitas premium.
                            <strong>Gratis ongkir</strong> untuk pembelian pertama! 🔥
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('catalog.index') }}" class="btn btn-hero-primary">
                                <i class="bi bi-bag-fill me-2"></i>Belanja Sekarang
                            </a>
                            <a href="#kategori" class="btn btn-hero-outline">
                                <i class="bi bi-grid-3x3-gap me-2"></i>Lihat Koleksi
                            </a>
                        </div>

                        {{-- Stats --}}
                        <div class="row hero-stats">
                            <div class="col-4 stat-item">
                                <h3>500+</h3>
                                <p>Produk</p>
                            </div>
                            <div class="col-4 stat-item">
                                <h3>10K+</h3>
                                <p>Customer</p>
                            </div>
                            <div class="col-4 stat-item">
                                <h3>4.8★</h3>
                                <p>Rating</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image-wrapper text-center">
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('storage/products/PITU BHEE-SPENDELAS.jpeg') }}"
                                 alt="Kaos Distro Original"
                                 class="img-fluid"
                                 style="max-height: 500px;">

                            {{-- Badge Diskon --}}
                            <div class="badge-discount">
                                -50%
                            </div>

                            {{-- Badge New --}}
                            <div class="badge-new">
                                <i class="bi bi-lightning-fill me-1"></i>NEW
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Populer --}}
    <section class="py-5" id="kategori" style="background: #f8f9fa;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title">Kategori Populer</h2>
                <p class="section-subtitle">Pilih kategori favorit kamu</p>
            </div>
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                           class="text-decoration-none">
                            <div class="card border-0 shadow-sm text-center h-100 category-card">
                                <div class="card-body">
                                    <div class="category-image-wrapper d-inline-block">
                                        <img src="{{ $category->image_url }}"
                                             alt="{{ $category->name }}"
                                             class="rounded-circle"
                                             width="90" height="90"
                                             style="object-fit: cover;">
                                    </div>
                                    <h6 class="category-name">
                                        {{ $category->name }}
                                    </h6>
                                    <small class="category-count">
                                        <i class="bi bi-box-seam me-1"></i>{{ $category->products_count }} produk
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h2 class="section-title mb-2">🔥 Produk Unggulan</h2>
                    <p class="section-subtitle">Best seller minggu ini</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark btn-lg">
                    Lihat Semua <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('profile.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Promo Banner --}}
    <section class="py-5" style="background: #f8f9fa;">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card promo-card promo-card-flash text-dark">
                        <div class="card-body d-flex flex-column justify-content-center p-5 position-relative">
                            <i class="bi bi-lightning-charge-fill promo-icon"></i>
                            <h3 class="fw-bold">⚡ Flash Sale!</h3>
                            <p>
                                Diskon hingga <strong>50%</strong> untuk produk pilihan.<br>
                                Buruan sebelum kehabisan!
                            </p>
                            <a href="#" class="btn btn-dark btn-promo" style="width: fit-content;">
                                <i class="bi bi-bag-check me-2"></i>Lihat Promo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card promo-card promo-card-member text-white">
                        <div class="card-body d-flex flex-column justify-content-center p-5 position-relative">
                            <i class="bi bi-gift-fill promo-icon"></i>
                            <h3 class="fw-bold">🎁 Member Baru?</h3>
                            <p>
                                Dapatkan voucher <strong>Rp 50.000</strong> untuk pembelian pertama kamu!
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-light btn-promo" style="width: fit-content;">
                                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Terbaru --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title">✨ Produk Terbaru</h2>
                <p class="section-subtitle">Koleksi terbaru yang baru saja masuk</p>
            </div>
            <div class="row g-4">
                @foreach($latestProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('profile.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Newsletter Section --}}
    <section class="newsletter-section py-5">
        <div class="container py-4">
            <div class="row justify-content-center text-center text-white position-relative">
                <div class="col-lg-7">
                    <h3 class="newsletter-title">📧 Dapatkan Update Terbaru!</h3>
                    <p class="mb-4" style="font-size: 1.1rem; opacity: 0.9;">
                        Subscribe newsletter untuk mendapatkan info promo, diskon, dan produk terbaru
                    </p>
                    <div class="input-group input-group-lg shadow-lg">
                        <input type="email" class="form-control newsletter-input" placeholder="Masukkan email kamu">
                        <button class="btn newsletter-btn" type="button">
                            <i class="bi bi-send-fill me-2"></i>Subscribe
                        </button>
                    </div>
                    <small class="d-block mt-3" style="opacity: 0.7;">
                        <i class="bi bi-lock-fill me-1"></i>Email kamu aman bersama kami
                    </small>
                </div>
            </div>
        </div>
    </section>
@endsection
