@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Homestay</h2>
    <form action="{{ route('homestays.update', $homestay->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('homestays.form', ['homestay' => $homestay])
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('homestays.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
am