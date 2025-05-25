@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="shadow card">
                    <div class="p-5 card-body">
                        <div class="mb-4 text-center">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="mb-3"
                                style="max-width: 150px;">
                            <h2 class="fw-bold">Reset Password</h2>
                            <p class="text-muted">Enter your new password below</p>
                        </div>
                        @if (session('status'))
                            <p class="text-center text-danger">
                                {{ session('status') }}
                            </p>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $request->email) }}" required
                                    autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        Please confirm your password.
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary btn-lg">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
