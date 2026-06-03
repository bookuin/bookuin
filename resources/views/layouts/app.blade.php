<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','BookuIn')</title>
    <link rel="stylesheet" href="/css/bookuin.css?v=3">
    @stack('head')
</head>
<body>
<nav class="nav">
    <a class="brand" href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard')) : route('public.books.index') }}">📚 BookuIn</a>
    <div class="menu">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.books.index') }}">Buku</a>
                <a href="{{ route('admin.users.index') }}">User</a>
                <a href="{{ route('admin.entries.index') }}">Masuk</a>
                <a href="{{ route('admin.exits.index') }}">Keluar</a>
                <a href="{{ route('admin.orders.index') }}">Order</a>
                <a href="{{ route('admin.reports.index') }}">Laporan</a>
            @else
                <a href="{{ route('user.books.index') }}">Buku</a>
                <a href="{{ route('user.cart.index') }}">Keranjang</a>
                <a href="{{ route('user.orders.index') }}">Order Saya</a>
            @endif
            <form method="post" action="{{ route('logout') }}" style="display:inline">@csrf<button class="btn light">Logout</button></form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Daftar</a>
        @endauth
    </div>
</nav>
<main class="container">
    @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert error"><strong>Terjadi kesalahan:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @yield('content')
</main>
@stack('scripts')
</body>
</html>
