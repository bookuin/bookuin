@extends('layouts.app')
@section('content')
<div class="actions"><h1 style="flex:1">Buku Keluar</h1><a class="btn" href="{{ route('admin.exits.create') }}">Tambah Buku Keluar</a></div>
<div class="card"><table class="table"><tr><th>Tanggal</th><th>Buku</th><th>Jumlah</th><th>Tujuan</th><th>Admin</th><th>Aksi</th></tr>@foreach($exits as $exit)<tr><td>{{ $exit->exit_date->format('d/m/Y') }}</td><td>{{ $exit->book?->title }}</td><td>{{ $exit->quantity }}</td><td>{{ $exit->destination }}</td><td>{{ $exit->user?->name }}</td><td><form method="post" action="{{ route('admin.exits.destroy',$exit) }}">@csrf @method('delete')<button class="btn danger" onclick="return confirm('Hapus dan tambah stok kembali?')">Hapus</button></form></td></tr>@endforeach</table>{{ $exits->links() }}</div>
@endsection
