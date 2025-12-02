@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="p-4 border rounded">

                <form class="row g-3 needs-validation" action="{{ route('barangs.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- NAMA --}}
                    <div class="col-md-4 position-relative">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="col-md-4 position-relative">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JUMLAH --}}
                    <div class="col-md-4 position-relative">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ old('jumlah') }}" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KONDISI --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label">Kondisi</label>
                        <input type="text" name="kondisi" class="form-control @error('kondisi') is-invalid @enderror"
                            value="{{ old('kondisi') }}" required>
                        @error('kondisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- LOKASI --}}
                    <div class="col-md-3 position-relative">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                            value="{{ old('lokasi') }}" required>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
