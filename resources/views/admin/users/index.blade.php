@extends('layouts.app')
@section('content')
<div class="actions"><h1 style="flex:1">Data User</h1><a class="btn" href="{{ route('admin.users.create') }}">Tambah User</a></div>
<div class="card"><table class="table"><tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Aksi</th></tr>@foreach($users as $user)<tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td><span class="badge">{{ $user->role }}</span></td><td>{{ $user->status ? 'Aktif' : 'Nonaktif' }}</td><td class="actions"><a class="btn light" href="{{ route('admin.users.edit',$user) }}">Edit</a><form method="post" action="{{ route('admin.users.destroy',$user) }}">@csrf @method('delete')<button class="btn danger" onclick="return confirm('Hapus?')">Hapus</button></form></td></tr>@endforeach</table>{{ $users->links() }}</div>
@endsection
