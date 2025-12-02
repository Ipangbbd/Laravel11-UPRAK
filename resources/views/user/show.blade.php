@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Detail User</h5>

        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
            </tr>
        </table>

        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
