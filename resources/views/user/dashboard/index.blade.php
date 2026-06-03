@extends('layouts.app')

@section('title', 'BookuIn - Perpustakaan Digital')

@section('content')

<section class="hero">
    <div class="hero-text">
        <h1>
            Perpustakaan Digital
            <span>Platform BookuIn</span>
        </h1>

        <p>
            Akses literasi tanpa batas. Temukan koleksi buku, kelola pesanan,
            dan nikmati layanan perpustakaan digital dalam satu platform.
        </p>

        <div class="hero-actions">
            <a href="{{ auth()->check() && auth()->user()->role === 'user' ? route('user.books.index') : url('/books') }}" class="btn btn-primary btn-large">
                Mulai Sekarang →
            </a>

            <a href="#koleksi" class="btn btn-outline btn-large">
                Lihat Koleksi
            </a>
        </div>

        <div class="hero-stats">
            <div>
                <b>1000+</b>
                <span>Koleksi Buku</span>
            </div>
            <div>
                <b>24/7</b>
                <span>Akses</span>
            </div>
            <div>
                <b>100%</b>
                <span>Digital</span>
            </div>
        </div>
    </div>

    <div class="hero-image">
        <div class="phone phone-a">
            <div class="phone-screen">
                <div class="phone-header">BookuIn</div>
                <div class="phone-search"></div>
                <div class="phone-books">
                    <div>B</div>
                    <div>O</div>
                    <div>O</div>
                    <div>K</div>
                </div>
            </div>
        </div>

        <div class="phone phone-b">
            <div class="phone-screen second">
                <div class="phone-card"></div>
                <div class="phone-line"></div>
                <div class="phone-line short"></div>
            </div>
        </div>

        <div class="badge-floating">● Multi-Platform</div>
    </div>
</section>

<section id="tentang" class="section">
    <div class="section-title">
        <h2>Apa itu Perpustakaan Digital BookuIn?</h2>
        <p>Tak kenal maka tak sayang, kenalan dulu yuk dengan platform kami.</p>
    </div>

    <div class="about">
        <div class="about-visual">
            <div class="big-phone">
                <div class="big-phone-title">Koleksi Buku</div>
                <div class="big-phone-search"></div>
                <div class="big-phone-grid">
                    <div>📘</div>
                    <div>📙</div>
                    <div>📗</div>
                    <div>📕</div>
                    <div>📔</div>
                    <div>📓</div>
                </div>
            </div>
        </div>

        <div class="about-content">
            <div class="info-box">
                <p>
                    BookuIn merupakan platform digital untuk membantu pengguna
                    mencari buku, melakukan pemesanan, pembayaran, dan memantau
                    riwayat transaksi secara mudah.
                </p>
            </div>

            <div class="info-box border-gradient">
                <p>
                    Admin dapat mengelola data buku, user, buku masuk, buku keluar,
                    biaya kirim, dashboard statistik, laporan PDF, dan export Excel.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="keunggulan" class="section">
    <div class="section-title">
        <h2>Fitur Unggulan Kami</h2>
        <p>BookuIn memiliki fitur unggulan yang membuat pengelolaan buku lebih mudah.</p>
    </div>

    <div class="features">
        <div class="feature-card">
            <div class="feature-icon">🌐</div>
            <h3>Berbasis Web</h3>
            <p>Akses sistem dari browser tanpa perlu instal aplikasi tambahan.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📚</div>
            <h3>Koleksi Buku</h3>
            <p>Pengguna dapat melihat katalog buku, detail, stok, dan harga.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">💳</div>
            <h3>Payment Gateway</h3>
            <p>Pembayaran dapat dilakukan melalui integrasi Midtrans.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Laporan</h3>
            <p>Admin dapat membuat laporan PDF dan export data Excel.</p>
        </div>
    </div>
</section>

<section id="koleksi" class="section books-section">
    <div class="section-title">
        <h2>Koleksi Buku Digital</h2>
        <p>Jelajahi berbagai koleksi buku digital yang tersedia di BookuIn.</p>
    </div>

    <div class="book-slider">
        <div class="book-card">
            <div class="book-cover cover-one">
                <span>UMUM</span>
                <b>Laravel Cepat</b>
            </div>
            <h3>Laravel Cepat untuk Pemula</h3>
            <p>Teknologi</p>
        </div>

        <div class="book-card">
            <div class="book-cover cover-two">
                <span>BISNIS</span>
                <b>Toko Buku</b>
            </div>
            <h3>Manajemen Toko Buku Modern</h3>
            <p>Bisnis</p>
        </div>

        <div class="book-card">
            <div class="book-cover cover-three">
                <span>NOVEL</span>
                <b>Cerita Rak Ketiga</b>
            </div>
            <h3>Cerita di Rak Ketiga</h3>
            <p>Novel</p>
        </div>

        <div class="book-card">
            <div class="book-cover cover-four">
                <span>PENDIDIKAN</span>
                <b>Database</b>
            </div>
            <h3>Belajar Database MySQL</h3>
            <p>Pendidikan</p>
        </div>

        <div class="book-card">
            <div class="book-cover cover-five">
                <span>AGAMA</span>
                <b>Literasi</b>
            </div>
            <h3>Literasi Digital Modern</h3>
            <p>Umum</p>
        </div>
    </div>

    <div class="center">
        <a href="{{ auth()->check() && auth()->user()->role === 'user' ? route('user.books.index') : url('/books') }}" class="btn btn-primary btn-large">
            Lihat Semua Buku →
        </a>
    </div>
</section>

<section class="section faq-section">
    <div class="faq-art">
        <div class="question">?</div>
    </div>

    <div class="faq-list">
        <div class="faq-item active">
            <h3>Apa itu Platform BookuIn?</h3>
            <p>BookuIn adalah platform digital untuk katalog buku, stok, transaksi, dan laporan.</p>
        </div>

        <div class="faq-item">
            <h3>Bagaimana caranya membeli buku?</h3>
            <p>Login sebagai user, pilih buku, masukkan keranjang, checkout, lalu bayar.</p>
        </div>

        <div class="faq-item">
            <h3>Apakah admin bisa membuat laporan?</h3>
            <p>Bisa. Admin dapat mencetak laporan PDF dan export Excel.</p>
        </div>
    </div>
</section>

<section id="pendaftaran" class="section">
    <div class="section-title">
        <h2>Jadilah Bagian dari Kami</h2>
        <p>Tumbuh bersama, jadilah bagian dalam perjalanan BookuIn.</p>
    </div>

    <div class="join-box">
        <div class="join-list">
            <div class="join-item">
                <h3>Daftar Member</h3>
                <p>Bergabung sebagai user dan mulai jelajahi koleksi buku.</p>
            </div>

            <div class="join-item active">
                <h3>Daftar Supplier</h3>
                <p>Bantu perpustakaan memperkaya koleksi buku yang tersedia.</p>
            </div>

            <div class="join-item">
                <h3>Daftar Mitra</h3>
                <p>Kembangkan jaringan perpustakaan digital bersama BookuIn.</p>
            </div>
        </div>

        <div class="join-image">
            <div>🤝</div>
        </div>
    </div>
</section>

<section class="section contact-section">
    <div class="section-title">
        <h2>Hubungi Kami</h2>
        <p>Ada pertanyaan? Kami siap membantu Anda.</p>
    </div>

    <div class="contact-box">
        <div>
            <h3>Butuh Bantuan?</h3>
            <p>Tim BookuIn siap membantu pertanyaan seputar layanan perpustakaan digital.</p>

            <a href="https://wa.me/6281234567890" target="_blank" class="wa-box">
                <span>☎</span>
                <div>
                    <b>Chat WhatsApp</b>
                    <small>Respon cepat melalui WhatsApp</small>
                </div>
                <strong>›</strong>
            </a>
        </div>

        <div class="contact-phone">
            <div>👩‍💻</div>
        </div>
    </div>
</section>

@endsection
