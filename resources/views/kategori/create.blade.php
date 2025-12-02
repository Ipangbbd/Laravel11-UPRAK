@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('kategoris.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}" required>

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
@endsection
