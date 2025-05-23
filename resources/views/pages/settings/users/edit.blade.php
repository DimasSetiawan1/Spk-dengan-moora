@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <div class="container py-5 mt-5">
            <div class="mx-auto border-0 rounded shadow card w-50">
                <div class="p-3 text-center card-title">
                    <h1>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h1>

                </div>
                <div class="mx-auto card-body w-75">
                    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        <div class="my-3 form-group">
                            <label for="name" class="mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}"
                                required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="username" class="mb-2">Username</label>
                            <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                id="username" name="username"
                                value="{{ old('username', isset($user) ? $user->username : '') }}" required>
                            @if ($errors->has('username'))
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                id="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}"
                                required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                id="password" name="password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        {{ isset($user) ? $user->role : '' }}
                        <div class="my-3 form-group">
                            <label for="role" class="mb-2">Role</label>
                            <select class="form-select {{ $errors->has('role') ? 'is-invalid' : '' }}" id="role"
                                name="role" required>
                                <option value="">Pilih Role</option>
                                @if (isset($user))
                                    <option value="admin"
                                        {{ old('role', isset($user) ? $user->role : '') === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="user"
                                        {{ old('role', isset($user) ? $user->role : '') === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                @else
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                @endif
                            </select>
                            @if ($errors->has('role'))
                                <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                            @endif
                        </div>

                        <div class="my-3 form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($user) ? 'Edit' : 'Buat' }}
                            </button>
                            <a href="{{ route('users.index') }}" class="ml-2 btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
