@extends('layouts.app')
@section('content')
<div class="actions"><h1 style="flex:1">Buku Masuk</h1><a class="btn" href="{{ route('admin.entries.create') }}">Tambah Buku Masuk</a></div>
<div class="card"><table class="table"><tr><th>Tanggal</th><th>Buku</th><th>Jumlah</th><th>Supplier</th><th>Admin</th><th>Aksi</th></tr>@foreach($entries as $entry)<tr><td>{{ $entry->entry_date->format('d/m/Y') }}</td><td>{{ $entry->book?->title }}</td><td>{{ $entry->quantity }}</td><td>{{ $entry->supplier }}</td><td>{{ $entry->user?->name }}</td><td><form method="post" action="{{ route('admin.entries.destroy',$entry) }}">@csrf @method('delete')<button class="btn danger" onclick="return confirm('Hapus dan kurangi stok?')">Hapus</button></form></td></tr>@endforeach</table>{{ $entries->links() }}</div>
@endsection
