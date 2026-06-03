@extends('layouts.app')
@section('content')
<div class="card"><h1>Tambah Buku Masuk</h1><form method="post" action="{{ route('admin.entries.store') }}">@csrf
<div class="form-row"><div class="form-group"><label>Buku</label><select name="book_id" required>@foreach($books as $book)<option value="{{ $book->id }}">{{ $book->title }} - stok {{ $book->stock }}</option>@endforeach</select></div><div class="form-group"><label>Jumlah</label><input type="number" name="quantity" min="1" required></div><div class="form-group"><label>Tanggal</label><input type="date" name="entry_date" value="{{ old('entry_date', now()->toDateString()) }}" required></div></div>
<div class="form-group"><label>Supplier</label><input name="supplier"></div><div class="form-group"><label>Keterangan</label><textarea name="note"></textarea></div><button class="btn">Simpan</button></form></div>
@endsection
