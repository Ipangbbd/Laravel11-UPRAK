@extends('layouts.auth')

@section('content')
    <main class="authentication-content">
        <div class="container-fluid">
            <div class="authentication-card">
                <div class="card shadow rounded-0 overflow-hidden">
                    <div class="row g-0">

                        {{-- Bagian kiri (gambar) --}}
                        <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/error/login-img.jpg') }}" class="img-fluid" alt="login">
                        </div>

                        {{-- Bagian kanan (form login) --}}
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title text-center mb-4">Login</h5>

                                <form class="form-body" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row g-3">

                                        {{-- Email --}}
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address</label>

                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i class="bi bi-envelope-fill"></i>
                                                </div>

                                                <input type="email" id="email" name="email"
                                                    value="{{ old('email') }}" required autofocus
                                                    class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                    placeholder="Email Address">

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

                                                <input type="password" id="password" name="password" required
                                                    class="form-control radius-30 ps-5 @error('password') is-invalid @enderror"
                                                    placeholder="Enter Password">

                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Remember Me --}}
                                        <div class="col-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Tombol Login --}}
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary radius-30">
                                                    Login
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Link Register (Opsional) --}}
                                        <div class="col-12">
                                            <p class="mb-0">
                                                Tidak memiliki akun?
                                                <a href="{{ route('register') }}">Registrasi</a>
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
