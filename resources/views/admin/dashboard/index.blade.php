@extends('layouts.app')
@section('title','Admin Dashboard - BookuIn')
@section('content')
<h1>Dashboard Admin</h1>
<div class="grid">
@foreach(['books'=>'Total Buku','users'=>'Total User','stock'=>'Total Stok','paid'=>'Order Paid','entries_month'=>'Buku Masuk Bulan Ini','exits_month'=>'Buku Keluar Bulan Ini'] as $key=>$label)
<div class="card"><div class="muted">{{ $label }}</div><div class="stat">{{ number_format($stats[$key]) }}</div></div>
@endforeach
<div class="card"><div class="muted">Revenue Paid</div><div class="stat">Rp {{ number_format($stats['revenue'],0,',','.') }}</div></div>
</div>
<div class="grid">
<div class="card"><h2>Stok Terendah</h2><table class="table"><tr><th>Buku</th><th>Stok</th></tr>@foreach($topBooks as $book)<tr><td>{{ $book->title }}</td><td>{{ $book->stock }}</td></tr>@endforeach</table></div>
<div class="card"><h2>Penjualan 7 Hari Terakhir</h2><table class="table"><tr><th>Tanggal</th><th>Total</th></tr>@foreach($sales as $sale)<tr><td>{{ $sale->date }}</td><td>Rp {{ number_format($sale->total,0,',','.') }}</td></tr>@endforeach</table></div>
</div>
@endsection
