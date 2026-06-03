@extends('layouts.app')

@section('title', 'BookuIn - Perpustakaan Digital')

@section('content')
<section class="hero-section">
    <div class="hero-content">
        <span class="eyebrow">Platform Perpustakaan Digital</span>

        <h1>
            Perpustakaan Digital
            <span>Platform BookuIn</span>
        </h1>

        <p>
            Akses koleksi buku, kelola pesanan, dan nikmati pengalaman membaca
            yang lebih modern dalam satu platform.
        </p>

        <div class="hero-buttons">
            <a class="btn btn-primary btn-big" href="{{ route('public.books.index') }}">
                Mulai Sekarang →
            </a>
            <a class="btn btn-outline btn-big" href="{{ route('public.books.index') }}">
                Lihat Koleksi
            </a>
        </div>

        <div class="hero-stats">
            <div>
                <strong>1000+</strong>
                <span>Koleksi Buku</span>
            </div>
            <div>
                <strong>24/7</strong>
                <span>Akses</span>
            </div>
            <div>
                <strong>100%</strong>
                <span>Digital</span>
            </div>
        </div>
    </div>

    <div class="hero-visual">
        <div class="phone phone-one">
            <div class="phone-top"></div>
            <div class="phone-search"></div>
            <div class="phone-books">
                <div class="mini-book">B</div>
                <div class="mini-book">O</div>
                <div class="mini-book">O</div>
                <div class="mini-book">K</div>
            </div>
        </div>

        <div class="phone phone-two">
            <div class="phone-top"></div>
            <div class="phone-card"></div>
            <div class="phone-line"></div>
            <div class="phone-line short"></div>
        </div>

        <div class="floating-badge">● Multi-Platform</div>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <h2>Apa itu BookuIn?</h2>
        <p>BookuIn adalah platform perpustakaan digital untuk mengelola dan mencari buku secara modern.</p>
    </div>

    <div class="feature-grid">
        <div class="feature-card">
            <div class="feature-icon">🌐</div>
            <h3>Berbasis Web</h3>
            <p>Bisa diakses lewat browser tanpa instal aplikasi.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📚</div>
            <h3>Koleksi Buku</h3>
            <p>Pengguna bisa melihat daftar buku, detail, harga, dan stok.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">💳</div>
            <h3>Payment Gateway</h3>
            <p>Pembayaran bisa menggunakan Midtrans.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Laporan</h3>
            <p>Admin bisa export PDF dan Excel.</p>
        </div>
    </div>
</section>
@endsection
