@extends('layouts.main')

@section('content')
<h1>Tambah Homestay</h1>
<form action="{{ route('homestays.store') }}" method="POST">
    @csrf
    @include('homestays.form', ['homestay' => null])
</form>

@if(session('success'))
    <script>
        window.location.href = "{{ route('homestays.index') }}";
    </script>
@endif
@endsection
