@extends('layouts.main')

@section('content')
    <h2>Tambah Pembayaran</h2>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        @include('payments.form')

        <div class="mt-3">
           
        </div>
    </form>
@endsection
