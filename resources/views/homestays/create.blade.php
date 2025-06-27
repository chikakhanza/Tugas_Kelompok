@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Tambah Homestay</h2>
    <form action="{{ route('homestays.store') }}" method="POST">
        @csrf
        @include('homestays.form')
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('homestays.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
