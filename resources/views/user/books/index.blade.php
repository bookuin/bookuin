@extends('layouts.app')
@section('content')
<h1>Katalog Buku</h1>
<div class="card"><form><input name="q" placeholder="Cari buku..." value="{{ request('q') }}"></form></div>
<div class="grid">@foreach($books as $book)<div class="card">@if($book->cover)<img class="cover" src="{{ asset('storage/'.$book->cover) }}">@endif<h3>{{ $book->title }}</h3><p class="muted">{{ $book->author }}<br>{{ $book->category?->name }} | Stok {{ $book->stock }}</p><p class="price">Rp {{ number_format($book->price,0,',','.') }}</p><a class="btn light" href="{{ auth()->check() ? route('user.books.show',$book) : route('login') }}">Detail</a></div>@endforeach</div>{{ $books->links() }}
@endsection
