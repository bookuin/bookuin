@extends('layouts.app')
@section('content')
<div class="hero card"><h1>Selamat datang di BookuIn</h1><p class="muted">Beli buku, bayar lewat Midtrans, dan pantau riwayat pesananmu.</p><a class="btn" href="{{ route('user.books.index') }}">Lihat Buku</a></div>
<h2>Buku Terbaru</h2><div class="grid">@foreach($books as $book)<div class="card">@if($book->cover)<img class="cover" src="{{ asset('storage/'.$book->cover) }}">@endif<h3>{{ $book->title }}</h3><p class="muted">{{ $book->category?->name }} | Stok {{ $book->stock }}</p><p class="price">Rp {{ number_format($book->price,0,',','.') }}</p><a class="btn light" href="{{ route('user.books.show',$book) }}">Detail</a></div>@endforeach</div>
@endsection
