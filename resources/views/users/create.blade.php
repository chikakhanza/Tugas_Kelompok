@extends('layouts.main')

@section('content')
    <h2>Tambah Pengguna</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        @include('users.form')
        <button type="submit">Simpan</button>
    </form>
@endsection
