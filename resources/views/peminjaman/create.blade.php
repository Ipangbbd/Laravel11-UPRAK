@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">

        <h5 class="mb-3">Tambah Peminjaman</h5>

        <form action="{{ route('peminjamans.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Barang</label>
                    <select name="barang_id" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
                        @endforeach
                    </select>
                    @error('barang_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">User</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" placeholder="Dipinjam / Kembali" required>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                    @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                    @error('tanggal_kembali') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>

    </div>
</div>
@endsection
