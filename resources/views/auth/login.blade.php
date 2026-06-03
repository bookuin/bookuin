@extends('layouts.app')
@section('title','Login - BookuIn')
@section('content')
<div class="card" style="max-width:480px;margin:50px auto">
    <h1>Login BookuIn</h1>
    <form method="post" action="{{ route('login.store') }}">@csrf
        <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
        <label><input type="checkbox" name="remember" style="width:auto"> Ingat saya</label><br><br>
        <button class="btn">Login</button>
        <a href="{{ route('register') }}" class="btn light">Daftar User</a>
    </form>
    <p class="muted">Demo admin: admin@bookuin.test / password</p>
</div>
@endsection
