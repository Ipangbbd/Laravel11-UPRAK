@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Tambah User</h5>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Roles</label>
                <select name="roles[]" class="form-control" multiple required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
