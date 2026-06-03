<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BookuIn')</title>
    <link rel="stylesheet" href="/css/bookuin.css?v=50">
</head>
<body>

<nav class="navbar">
    <a href="/" class="brand">
        <span class="brand-icon">📚</span>
        <span>
            <b>BookuIn</b>
            <small>Digital Book Platform</small>
        </span>
    </a>

    <div class="nav-menu">
        <a href="/">Home</a>
        <a href="/#tentang">Tentang</a>
        <a href="/#keunggulan">Keunggulan</a>
        <a href="{{ auth()->check() && auth()->user()->role === 'user' ? route('user.books.index') : url('/books') }}">Koleksi Buku</a>
        <a href="/#pendaftaran">Pendaftaran</a>
    </div>

    <div class="nav-right">
        <form class="nav-search" action="{{ auth()->check() && auth()->user()->role === 'user' ? route('user.books.index') : url('/books') }}" method="get">
            <span>⌕</span>
            <input type="text" name="q" placeholder="Cari buku, penulis...">
        </form>

        @auth
            @if(auth()->user()->role === 'admin')
                <a class="btn btn-soft" href="{{ route('admin.dashboard') }}">Admin</a>
            @else
                <a href="{{ route('user.cart.index') }}">Keranjang</a>
                <a href="{{ route('user.orders.index') }}">Order Saya</a>
            @endif

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-soft" type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
        @endauth
    </div>
</nav>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert error">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<main>
    @yield('content')
</main>

<footer class="footer">
    <b>BookuIn</b>
    <span>© {{ date('Y') }} Platform Perpustakaan Digital</span>
</footer>

</body>
</html>
