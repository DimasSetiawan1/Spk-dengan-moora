@extends('layouts.main')

@section('content')
    <div class="container p-0 mt-3 overflow-hidden">
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

                    <form action="{{ route('password.email') }}" method="post">
                        @csrf
                        <!-- Input Email -->
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <img src="{{ asset('assets/icons/email.svg') }}" alt="" srcset="">

                                </span>
                                <input type="email" class="form-control @error('email')  is-invalid @enderror"
                                    name="email" id="email" placeholder="Masukkan email Anda"
                                    value="{{ old('email') }}" autofocus required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 text-start">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @error('g-recaptcha-response')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Login -->
                        <button class="py-2 btn btn-dark w-100" type="submit">Forgot Password</button>
                    </form>
                </main>
            </div>

            <!-- Bagian Gambar -->
            <div class="p-0 col-md-6 col-sm-12">
                <img src="{{ asset('assets/images/banner-login.png') }}" class="img-fluid w-100 h-100 object-fit-cover"
                    alt="Banner Login">
            </div>
        </div>
    </div>
@endsection
