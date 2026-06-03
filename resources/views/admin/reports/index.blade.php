@extends('layouts.app')
@section('content')
<h1>Laporan PDF & Export Excel</h1>
<div class="grid">
<div class="card"><h2>PDF</h2><p class="actions"><a class="btn" href="{{ route('admin.reports.books.pdf') }}">Data Buku PDF</a><a class="btn" href="{{ route('admin.reports.stock.pdf') }}">Stok PDF</a><a class="btn" href="{{ route('admin.reports.entries.pdf') }}">Buku Masuk PDF</a><a class="btn" href="{{ route('admin.reports.exits.pdf') }}">Buku Keluar PDF</a><a class="btn" href="{{ route('admin.reports.orders.pdf') }}">Transaksi PDF</a></p></div>
<div class="card"><h2>Excel</h2><p class="actions"><a class="btn success" href="{{ route('admin.reports.books.excel') }}">Buku Excel</a><a class="btn success" href="{{ route('admin.reports.users.excel') }}">User Excel</a><a class="btn success" href="{{ route('admin.reports.orders.excel') }}">Transaksi Excel</a></p></div>
</div>
@endsection
