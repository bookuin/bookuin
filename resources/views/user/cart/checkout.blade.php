@extends('layouts.app')
@section('content')
<h1>Checkout</h1>
<div class="card"><table class="table"><tr><th>Buku</th><th>Qty</th><th>Total</th></tr>@php($grand=0)@foreach($items as $item)@php($grand += $item['total'])<tr><td>{{ $item['book']->title }}</td><td>{{ $item['quantity'] }}</td><td>Rp {{ number_format($item['total'],0,',','.') }}</td></tr>@endforeach<tr><th colspan="2">Subtotal</th><th>Rp {{ number_format($grand,0,',','.') }}</th></tr></table></div>
<div class="card"><form method="post" action="{{ route('user.checkout.store') }}">@csrf<div class="form-group"><label>Pilih Biaya Kirim</label><select name="shipping_cost_id" required>@foreach($shippingCosts as $ship)<option value="{{ $ship->id }}">{{ $ship->city }} - {{ $ship->courier }} - Rp {{ number_format($ship->cost,0,',','.') }} ({{ $ship->estimated_days }})</option>@endforeach</select></div><button class="btn">Buat Order & Bayar</button></form></div>
@endsection
