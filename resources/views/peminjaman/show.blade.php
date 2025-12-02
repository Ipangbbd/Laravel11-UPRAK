@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">

        <h5 class="mb-3">Detail Peminjaman</h5>

        <table class="table">
            <tr>
                <th>Barang</th>
                <td>{{ $peminjaman->barang->nama }}</td>
            </tr>

            <tr>
                <th>Peminjam</th>
                <td>{{ $peminjaman->user->name }}</td>
            </tr>

            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
            </tr>

            <tr>
                <th>Tanggal Kembali</th>
                <td>{{ $peminjaman->tanggal_kembali }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td><span class="badge bg-primary">{{ $peminjaman->status }}</span></td>
            </tr>
        </table>

        <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Kembali</a>

    </div>
</div>
@endsection
