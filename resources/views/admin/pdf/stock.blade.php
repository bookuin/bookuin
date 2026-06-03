@extends('admin.pdf.layout')
@section('pdf')<h1>Laporan Stok Buku</h1><p class="muted">BookuIn - {{ now()->format('d/m/Y H:i') }}</p><table><tr><th>No</th><th>Judul</th><th>Kategori</th><th>Stok</th></tr>@foreach($books as $book)<tr><td>{{ $loop->iteration }}</td><td>{{ $book->title }}</td><td>{{ $book->category?->name }}</td><td>{{ $book->stock }}</td></tr>@endforeach</table>@endsection
