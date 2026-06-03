@extends('layouts.app')
@section('title','Detail Order - BookuIn')
@push('head')
@if($order->snap_token && $order->payment_status !== 'paid')
<script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@endif
@endpush
@section('content')
<div class="card"><h1>Order {{ $order->order_code }}</h1><p>Payment: <span class="badge">{{ $order->payment_status }}</span> | Order: {{ $order->order_status }}</p>@if($order->snap_token && $order->payment_status !== 'paid')<button id="pay-button" class="btn success">Bayar Sekarang</button>@endif</div>
<div class="card"><table class="table"><tr><th>Buku</th><th>Qty</th><th>Harga</th><th>Total</th></tr>@foreach($order->items as $item)<tr><td>{{ $item->book?->title }}</td><td>{{ $item->quantity }}</td><td>Rp {{ number_format($item->price,0,',','.') }}</td><td>Rp {{ number_format($item->total,0,',','.') }}</td></tr>@endforeach<tr><th colspan="3">Subtotal</th><th>Rp {{ number_format($order->subtotal,0,',','.') }}</th></tr><tr><th colspan="3">Ongkir</th><th>Rp {{ number_format($order->shipping_cost,0,',','.') }}</th></tr><tr><th colspan="3">Total</th><th>Rp {{ number_format($order->total,0,',','.') }}</th></tr></table></div>
@endsection
@push('scripts')
@if($order->snap_token && $order->payment_status !== 'paid')
<script>document.getElementById('pay-button').onclick = function(){ snap.pay('{{ $order->snap_token }}', { onSuccess:function(){ location.reload(); }, onPending:function(){ location.reload(); }, onError:function(){ alert('Pembayaran gagal.'); }, onClose:function(){ alert('Popup pembayaran ditutup.'); } }); };</script>
@endif
@endpush
