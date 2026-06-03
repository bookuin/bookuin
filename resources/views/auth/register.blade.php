@extends('layouts.app')
@section('title','Daftar - BookuIn')
@section('content')
<div class="card" style="max-width:620px;margin:30px auto">
    <h1>Daftar User</h1>
    <form method="post" action="{{ route('register.store') }}">@csrf
        <div class="form-row">
            <div class="form-group"><label>Nama</label><input name="name" value="{{ old('name') }}" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-group"><label>Konfirmasi Password</label><input type="password" name="password_confirmation" required></div>
        </div>
        <div class="form-group"><label>No HP</label><input name="phone" value="{{ old('phone') }}"></div>
        <div class="form-group"><label>Alamat</label><textarea name="address">{{ old('address') }}</textarea></div>
        <button class="btn">Daftar</button>
    </form>
</div>
@endsection
