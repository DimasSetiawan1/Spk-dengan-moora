@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <div class="container py-5 mt-5">
            <div class="mx-auto border-0 rounded shadow card w-50">
                <div class="p-3 text-center card-title">
                    <h1>{{ isset($kriteria) ? 'Edit Kriteria' : 'Tambah Kriteria' }}</h1>
                </div>
                <div class="px-5 mx-auto card-body w-75">
                    <form action="{{ isset($kriteria) ? route('kriteria.update', $kriteria->id) : route('kriteria.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($kriteria))
                            @method('PUT')
                        @endif
                        <div class="my-3 form-group">
                            <label for="code" class="mb-2">Kode Kriteria</label>
                            <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                id="code" name="code"
                                value="{{ old('code', isset($kriteria) ? $kriteria->code : '') }}" required>
                            @if ($errors->has('code'))
                                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="name" class="mb-2">Nama Kriteria</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name" name="name"
                                value="{{ old('name', isset($kriteria) ? $kriteria->name : '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="bobot" class="mb-2">Bobot</label>
                            <input type="text" inputmode="decimal"
                                class="form-control {{ $errors->has('bobot') ? 'is-invalid' : '' }}" id="bobot"
                                name="bobot" value="{{ old('bobot', isset($kriteria) ? $kriteria->bobot : '') }}"
                                required>
                            @if ($errors->has('bobot'))
                                <div class="invalid-feedback">{{ $errors->first('bobot') }}</div>
                            @endif
                        </div>
                        <div class=" h-100">
                            <label for="keterangan" class="mb-2">keterangan</label>
                            <select
                                class=" form-select form-select-sm {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
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
                        <div class="my-3 text-center form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($kriteria) ? 'Edit' : 'Buat' }}
                            </button>
                            <a href="{{ route('kriteria.index') }}" class="ml-2 btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
