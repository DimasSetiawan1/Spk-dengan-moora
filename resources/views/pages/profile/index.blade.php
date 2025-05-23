@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <!-- Your main content goes here -->
        <h2 class='mt-3'>{{ $title }}</h2>
        @if (session('success'))
            <div id='successAlert' class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text"
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                    class="form-control @error('email')
                is-invalid

                @enderror"
                    id="email" name="email" value="{{ old('email', $user->email) }} " required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                    class="form-control @error('password')
                is-invalid

                @enderror"
                    id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control"
                    id="password_confirmation @error('password_confirmation')
                is-invalid

                @enderror"
                    name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}"
                    disabled>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('dashboard') }}" class="btn btn-danger">Kembali</a>
        </form>

    </main>
@endsection
