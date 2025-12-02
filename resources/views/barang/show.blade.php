@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="p-4 border rounded">

                <h5 class="mb-3">Detail Barang</h5>

                <div class="mb-3">
                    <strong>Nama:</strong> {{ $barang->nama }}
                </div>

                <div class="mb-3">
                    <strong>Kategori:</strong> {{ $barang->kategori->nama ?? '-' }}
                </div>

                <div class="mb-3">
                    <strong>Jumlah:</strong> {{ $barang->jumlah }}
                </div>

                <div class="mb-3">
                    <strong>Kondisi:</strong> {{ $barang->kondisi }}
                </div>

                <div class="mb-3">
                    <strong>Lokasi:</strong> {{ $barang->lokasi }}
                </div>

                <div class="mt-4">
                    <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>

                    @can('edit-barang')
                        <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                    @endcan
                </div>

            </div>
        </div>
    </div>

@endsection
