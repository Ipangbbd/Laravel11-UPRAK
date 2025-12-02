@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Daftar User</h5>
            @can('create-user')
                <a href="{{ route('user.create') }}" class="btn btn-outline-success btn-sm mb-3">+ User</a>
            @endcan

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <table class="table table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ implode(', ', $item->getRoleNames()->toArray()) }}</td>
                            <td class="text-center d-flex justify-content-center gap-2">
                                @can('show-user')
                                    <a href="{{ route('user.show', $item->id) }}" class="text-primary"><i
                                            class="bi bi-eye-fill"></i></a>
                                @endcan
                                @can('edit-user')
                                    <a href="{{ route('user.edit', $item->id) }}" class="text-warning"><i
                                            class="bi bi-pencil-fill"></i></a>
                                @endcan
                                @can('delete-user')
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-danger border-0 bg-transparent"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection