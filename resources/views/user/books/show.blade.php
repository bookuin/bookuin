@extends('layouts.app')
@section('content')
<div class="card"><div class="grid"><div>@if($book->cover)<img src="{{ asset('storage/'.$book->cover) }}" style="max-width:220px;border-radius:16px">@endif</div><div><h1>{{ $book->title }}</h1><p class="muted">{{ $book->author }} | {{ $book->publisher }} | {{ $book->year }}</p><p>{{ $book->description }}</p><p class="price">Rp {{ number_format($book->price,0,',','.') }}</p><p>Stok: {{ $book->stock }}</p><form method="post" action="{{ route('user.cart.add',$book) }}">@csrf<div class="form-group"><label>Jumlah</label><input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}"></div><button class="btn">Masukkan Keranjang</button></form></div></div></div>
@endsection
