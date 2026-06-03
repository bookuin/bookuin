@extends('layouts.app')
@section('content')
<div class="card"><h1>{{ $category->exists ? 'Edit' : 'Tambah' }} Kategori</h1><form method="post" action="{{ $category->exists ? route('admin.categories.update',$category) : route('admin.categories.store') }}">@csrf @if($category->exists)@method('put')@endif<div class="form-group"><label>Nama</label><input name="name" value="{{ old('name',$category->name) }}" required></div><button class="btn">Simpan</button></form></div>
@endsection
