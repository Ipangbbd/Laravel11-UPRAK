@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h5>Detail Kategori</h5>
        <hr>

        <p><strong>Nama:</strong> {{ $kategori->nama }}</p>

        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

@endsection
