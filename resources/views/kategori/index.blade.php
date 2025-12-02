@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-2">
        <h5 class="mb-0">List Kategori</h5>
    </div>
    @can('create-kategori')
        <a href="{{ route('kategoris.create') }}" class="btn btn-outline-success btn-sm mb-2">+ Kategori</a>
    @endcan


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-3">

                                        @can('view-kategori')
                                            <a href="{{ route('kategoris.show', $item->id) }}" class="text-primary"
                                                title="View">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endcan

                                        @can('edit-kategori')
                                            <a href="{{ route('kategoris.edit', $item->id) }}" class="text-warning"
                                                title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        @endcan

                                        @can('delete-kategori')
                                            <form action="{{ route('kategoris.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0 bg-transparent" title="Delete">
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
