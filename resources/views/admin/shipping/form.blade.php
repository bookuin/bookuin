@extends('layouts.app')
@section('content')
<div class="card"><h1>{{ $shippingCost->exists ? 'Edit' : 'Tambah' }} Biaya Kirim</h1><form method="post" action="{{ $shippingCost->exists ? route('admin.shipping.update',$shippingCost) : route('admin.shipping.store') }}">@csrf @if($shippingCost->exists)@method('put')@endif
<div class="form-row"><div class="form-group"><label>Kota</label><input name="city" value="{{ old('city',$shippingCost->city) }}" required></div><div class="form-group"><label>Kurir</label><input name="courier" value="{{ old('courier',$shippingCost->courier ?: 'Reguler') }}" required></div><div class="form-group"><label>Biaya</label><input type="number" name="cost" value="{{ old('cost',$shippingCost->cost) }}" required></div></div>
<div class="form-group"><label>Estimasi</label><input name="estimated_days" value="{{ old('estimated_days',$shippingCost->estimated_days) }}" placeholder="2-3 hari"></div><button class="btn">Simpan</button></form></div>
@endsection
