@extends('layouts.app')
@section('content')
<div class="actions"><h1 style="flex:1">Biaya Kirim</h1><a class="btn" href="{{ route('admin.shipping.create') }}">Tambah</a></div>
<div class="card"><table class="table"><tr><th>Kota</th><th>Kurir</th><th>Biaya</th><th>Estimasi</th><th>Aksi</th></tr>@foreach($shippingCosts as $shipping)<tr><td>{{ $shipping->city }}</td><td>{{ $shipping->courier }}</td><td>Rp {{ number_format($shipping->cost,0,',','.') }}</td><td>{{ $shipping->estimated_days }}</td><td class="actions"><a class="btn light" href="{{ route('admin.shipping.edit',$shipping) }}">Edit</a><form method="post" action="{{ route('admin.shipping.destroy',$shipping) }}">@csrf @method('delete')<button class="btn danger" onclick="return confirm('Hapus?')">Hapus</button></form></td></tr>@endforeach</table>{{ $shippingCosts->links() }}</div>
@endsection
