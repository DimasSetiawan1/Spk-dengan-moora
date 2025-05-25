@extends('layouts.main')

@section('content')
    <div class="container p-0 overflow-hidden">
        <div class="row h-100 g-0">
            <!-- Bagian Form Login -->

            <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center bg-light">
                <main class="text-center form-signin w-75">
                    @if (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo PT. Bintang Bunut" class="mb-4"
                        style="max-width: 200px;">
                    <h1 class="h4 fw-bold">Sistem pemilihan suplier cat</h1>
                    <p class="mb-4 text-muted">dengan Metode MOORA</p>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <!-- Input Email -->
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email / Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <img src="{{ asset('assets/icons/email.svg') }}" alt="" srcset="">

                                </span>
                                <input type="text" class="form-control @error('email')  is-invalid @enderror"
                                    name="email" id="email" placeholder="Masukkan email / username Anda"
                                    value="{{ old('email') }}" autofocus required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Input Password -->
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text ">
                                    <img src="{{ asset('assets/icons/password.svg') }}" alt=""
                                        srcset="">
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror "
                                    id="password" name="password" placeholder="Masukkan password Anda" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <!-- Tombol Login -->
                        <button class="py-2 btn btn-dark w-100" type="submit">Masuk</button>
                    </form>

                    <div class="container mt-4 mb-2">
                        <div class="row">
                            <div class="mb-2 col-12">
                                <a href="{{ route('register') }}" class="text-black text-decoration-none">
                                    Belum terdaftar? <b>Buat akun di sini.</b>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('password.request') }}" class="text-black text-decoration-none">
                                    Lupa kata sandi? <b>Reset di sini.</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <!-- Bagian Gambar -->
            <div class="p-0 col-md-6 col-sm-12">
                <img src="/assets/images/banner-login.png" class="img-fluid w-100 h-100 object-fit-cover"
                    alt="Banner Login">
            </div>
        </div>
    </div>
@endsection
