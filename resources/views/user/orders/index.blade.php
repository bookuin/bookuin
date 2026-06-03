@extends('layouts.app')
@section('content')
<h1>Order Saya</h1>
<div class="card"><table class="table"><tr><th>Kode</th><th>Total</th><th>Payment</th><th>Order</th><th>Tanggal</th><th>Aksi</th></tr>@foreach($orders as $order)<tr><td>{{ $order->order_code }}</td><td>Rp {{ number_format($order->total,0,',','.') }}</td><td><span class="badge">{{ $order->payment_status }}</span></td><td>{{ $order->order_status }}</td><td>{{ $order->created_at->format('d/m/Y H:i') }}</td><td><a class="btn light" href="{{ route('user.orders.show',$order) }}">Detail</a></td></tr>@endforeach</table>{{ $orders->links() }}</div>
@endsection
