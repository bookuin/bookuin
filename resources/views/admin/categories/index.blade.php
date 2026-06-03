@extends('layouts.app')
@section('content')
<div class="actions"><h1 style="flex:1">Kategori</h1><a class="btn" href="{{ route('admin.categories.create') }}">Tambah</a></div>
<div class="card"><table class="table"><tr><th>Nama</th><th>Aksi</th></tr>@foreach($categories as $category)<tr><td>{{ $category->name }}</td><td class="actions"><a class="btn light" href="{{ route('admin.categories.edit',$category) }}">Edit</a><form method="post" action="{{ route('admin.categories.destroy',$category) }}">@csrf @method('delete')<button class="btn danger" onclick="return confirm('Hapus?')">Hapus</button></form></td></tr>@endforeach</table>{{ $categories->links() }}</div>
@endsection
