@extends('layouts.main')

@section('content')
    <h2>Edit Pembayaran</h2>
    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('payments.form', ['payment' => $payment])
    
    </form>
@endsection
