@extends('layouts.main')

@section('content')
    <h2>Tambah Pembayaran</h2>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        @include('payments.form')

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
