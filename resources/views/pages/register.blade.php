@extends('layouts.main')

@section('content')
    <div class="container p-0 overflow-hidden">
        <div class="row h-100 g-0">
            <!-- Bagian Form Login -->
            <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center bg-light">
                <main class="text-center form-signin w-75">
                    <img src="/assets/images/logo.png" alt="Logo PT. Bintang Bunut" class="mb-4" style="max-width: 200px;">
                    <h1 class="h4 fw-bold">Daftar Akun</h1>
                    <p class="mb-4 text-muted">Lengkapi informasi di bawah ini untuk membuat akun Anda</p>

                    <form action="{{ route('register.store') }}" method="post">
                        @csrf
                        <!-- Input Nama  -->
                        <div class="mb-3 text-start">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <img src="{{ secure_asset('assets/icons/user.svg') }}" alt="" srcset="">

                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="Masukkan nama lengkap anda"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Input Username-->

                        <div class="mb-3 text-start">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <img src="{{ secure_asset('assets/icons/user.svg') }}" alt="" srcset="">

                                </span>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" id="username" placeholder="Masukkan username"
                                    value="{{ old('username') }}" required>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <img src="{{ secure_asset('assets/icons/email.svg') }}" alt="" srcset="">

                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="nama@email.com" value="{{ old('email') }}"
                                    required>
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
                                    <img src="{{ secure_asset('assets/icons/password.svg') }}" alt=""
                                        srcset="">
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Minimal 8 karater" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 text-start">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <img src="{{ secure_asset('assets/icons/password.svg') }}" alt=""
                                        srcset="">
                                </span>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation"
                                    placeholder="Masukan ulang password" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>



                        <!-- Tombol Login -->
                        <div class="input-group">

                            <button class="py-2 btn btn-dark w-100 d-flex align-items-center justify-content-center"
                                type="submit">
                                <img src="{{ secure_asset('assets/icons/userplus.svg') }}" alt="" class="me-2"
                                    style="width: 20px; height: 20px;">
                                <span class="text-center flex-grow-1">Daftar Sekarang</span>
                            </button>
                        </div>
                    </form>
                    <p class="mt-4 text-center">Sudah memiliki akun? <a href="{{ route('login') }}"
                            class="text-black text-decoration-none fw-bold">Masuk Disini</a></p>


                </main>
            </div>

            <!-- Bagian Gambar -->
            <div class="p-0 col-md-6 col-sm-12">
                <img src="/assets/images/banner-login.png" class="img-fluid w-100 h-100 object-fit-cover"
                    alt="Banner Login">
            </div>
        </div>
    </div>
    {{-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2021 PT. Bintang Bunut. All rights reserved.</p> --}}
@endsection
