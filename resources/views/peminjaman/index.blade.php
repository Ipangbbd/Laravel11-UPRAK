@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Daftar Peminjaman</h5>
                @can('create-peminjaman')
                <a href="{{ route('peminjamans.create') }}" class="btn btn-outline-success btn-sm mb-3">+ Peminjaman</a>
            @endcan
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Barang</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($peminjaman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barang->nama ?? '-' }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->tanggal_pinjam }}</td>
                                <td>{{ $item->tanggal_kembali }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $item->status }}</span>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-3">

                                        @can('show-peminjaman')
                                            <a href="{{ route('peminjamans.show', $item->id) }}" class="text-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endcan

                                        @can('edit-peminjaman')
                                            <a href="{{ route('peminjamans.edit', $item->id) }}" class="text-warning">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        @endcan

                                        @can('delete-peminjaman')
                                            <form action="{{ route('peminjamans.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0 bg-transparent">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
