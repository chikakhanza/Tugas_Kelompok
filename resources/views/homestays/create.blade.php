@extends('layouts.main')

@section('content')
<h1>Tambah Homestay</h1>
<form action="{{ route('homestays.store') }}" method="POST">
    @csrf
    @include('homestays.form', ['homestay' => null])
   
</form>
@endsection
