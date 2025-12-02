@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">

        <h5 class="mb-3">Edit Peminjaman</h5>

        <form action="{{ route('peminjamans.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Barang</label>
                    <select name="barang_id" class="form-control" required>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" {{ $peminjaman->barang_id == $b->id ? 'selected' : '' }}>
                                {{ $b->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">User</label>
                    <select name="user_id" class="form-control" required>
                        @foreach ($user as $u)
                            <option value="{{ $u->id }}" {{ $peminjaman->user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" value="{{ $peminjaman->status }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali }}" required>
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Update</button>
                    <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>

    </div>
</div>
@endsection
