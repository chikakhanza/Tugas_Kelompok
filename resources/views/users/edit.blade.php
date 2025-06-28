@extends('layouts.main')

@section('content')
    <h2>Edit Pengguna</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('users.form', ['user' => $user])
        <button type="submit">Update</button>
    </form>
@endsection
