@extends('layouts.main')

@section('content')
    <h2>Detail Pengguna</h2>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <a href="{{ route('users.index') }}">Kembali</a>
@endsection
