@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <!-- Responsive container with more padding on larger screens -->
        <div class="container py-3 mt-3 py-md-4 py-lg-5 mt-md-4 mt-lg-5">
            <!-- Card with responsive width -->
            <div class="mx-auto border-0 rounded shadow card col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="p-2 text-center p-md-3 card-title">
                    <h1 class="h2">{{ isset($kriteria) ? 'Edit Kriteria' : 'Tambah Kriteria' }}</h1>
                </div>
                <!-- Responsive padding -->
                <div class="px-3 mx-auto px-md-4 px-lg-5 card-body w-100">
                    <form action="{{ isset($kriteria) ? route('kriteria.update', $kriteria->id) : route('kriteria.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($kriteria))
                            @method('PUT')
                        @endif
                        <div class="mb-3 form-group">
                            <label for="code" class="mb-2 form-label">Kode Kriteria</label>
                            <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                id="code" name="code"
                                value="{{ old('code', isset($kriteria) ? $kriteria->code : '') }}" required>
                            @if ($errors->has('code'))
                                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label for="name" class="mb-2 form-label">Nama Kriteria</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name" name="name"
                                value="{{ old('name', isset($kriteria) ? $kriteria->name : '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label for="bobot" class="mb-2 form-label">Bobot</label>
                            <input type="text" inputmode="decimal"
                                class="form-control {{ $errors->has('bobot') ? 'is-invalid' : '' }}" id="bobot"
                                name="bobot" value="{{ old('bobot', isset($kriteria) ? $kriteria->bobot : '') }}"
                                required>
                            @if ($errors->has('bobot'))
                                <div class="invalid-feedback">{{ $errors->first('bobot') }}</div>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="keterangan" class="mb-2 form-label">Keterangan</label>
                            <select class="form-select {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                                id="keterangan" name="keterangan" required>

                                <option value="1"
                                    {{ old('keterangan', isset($kriteria) ? $kriteria->keterangan : '') == 1 ? 'selected' : '' }}>
                                    Benefit</option>
                                <option value="0"
                                    {{ old('keterangan', isset($kriteria) ? $kriteria->keterangan : '') == 0 ? 'selected' : '' }}>
                                    Cost
                                </option>
                            </select>
                            @if ($errors->has('keterangan'))
                                <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                            @endif
                        </div>
                        <div class="gap-2 my-3 text-center d-grid d-md-block">
                            <button type="submit" class="px-4 btn btn-primary me-md-2">
                                {{ isset($kriteria) ? 'Edit' : 'Buat' }}
                            </button>
                            <a href="{{ route('kriteria.index') }}" class="mt-2 btn btn-secondary mt-md-0">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
