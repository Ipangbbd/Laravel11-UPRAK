@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-2">
        <h5 class="mb-0">List Barang</h5>
    </div>

    @can('create-barang')
        <a href="{{ route('barangs.create') }}" class="btn btn-outline-success btn-sm mb-2">
            + Barang
        </a>
    @endcan

    <div class="card">
        <div class="card-body">

            <div class="table-responsive mt-3">

                @if ($barangs->count())
                    <table class="table align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kat.</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th>Lokasi</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($barangs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $item->nama }}</td>

                                    <td>{{ $item->kategori->nama ?? '-' }}</td>

                                    <td>{{ $item->jumlah }}</td>

                                    <td>{{ $item->kondisi }}</td>

                                    <td>{{ $item->lokasi }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-3">

                                            {{-- Show --}}
                                            @can('view-barang')
                                                <a href="{{ route('barangs.show', $item->id) }}" class="text-primary"
                                                    title="View">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            @endcan

                                            {{-- Edit --}}
                                            @can('edit-barang')
                                                <a href="{{ route('barangs.edit', $item->id) }}" class="text-warning"
                                                    title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            @endcan

                                            {{-- Delete --}}
                                            @can('delete-barang')
                                                <form action="{{ route('barangs.destroy', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="text-danger border-0 bg-transparent"
                                                        title="Delete">
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
                @else
                    <p class="text-center text-muted my-3">Belum ada data barang.</p>
                @endif

            </div>

            {{-- Pagination (opsional) --}}
            @if (method_exists($barangs, 'links'))
                <div class="mt-3">
                    {{ $barangs->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>

@endsection
