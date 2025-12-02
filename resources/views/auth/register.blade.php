@extends('layouts.auth')

@section('content')
<main class="authentication-content">
    <div class="container-fluid">
        <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
                <div class="row g-0">

                    {{-- Bagian kiri (gambar) --}}
                    <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/images/error/login-img.jpg') }}" class="img-fluid" alt="register">
                    </div>

                    {{-- Bagian kanan (form register) --}}
                    <div class="col-lg-6">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center mb-4">Register Akun</h5>

                            <form class="form-body" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row g-3">

                                    {{-- Nama --}}
                                    <div class="col-12">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-person-fill"></i>
                                            </div>

                                            <input
                                                type="text"
                                                id="name"
                                                name="name"
                                                value="{{ old('name') }}"
                                                required
                                                autofocus
                                                class="form-control radius-30 ps-5 @error('name') is-invalid @enderror"
                                                placeholder="Masukkan nama">

                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-envelope-fill"></i>
                                            </div>

                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                placeholder="Masukkan email">

                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>

                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                required
                                                class="form-control radius-30 ps-5 @error('password') is-invalid @enderror"
                                                placeholder="Masukkan password">

                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Konfirmasi Password --}}
                                    <div class="col-12">
                                        <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>

                                            <input
                                                type="password"
                                                id="password-confirm"
                                                name="password_confirmation"
                                                required
                                                class="form-control radius-30 ps-5"
                                                placeholder="Ulangi password">
                                        </div>
                                    </div>

                                    {{-- Tombol Daftar --}}
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary radius-30">
                                                Register
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Punya akun --}}
                                    <div class="col-12">
                                        <p class="mb-0">
                                            Sudah punya akun?
                                            <a href="{{ route('login') }}">Login</a>
                                        </p>
                                    </div>

                                </div> {{-- row g-3 --}}
                            </form>

                        </div>
                    </div>

                </div> {{-- row --}}
            </div>
        </div>
    </div>
</main>
@endsection
