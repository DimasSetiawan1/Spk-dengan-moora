@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <div class="container py-5 mt-5">
            <div class="mx-auto border-0 rounded shadow card w-50">
                <div class="p-3 text-center card-title">
                    <h1>{{ isset($subkriteria) ? 'Edit Subkriteria' : 'Tambah Subkriteria' }}</h1>

                </div>
                <div class="mx-auto card-body w-75">
                    <form
                        action="{{ isset($subkriteria) ? route('subkriteria.update', $subkriteria->id) : route('subkriteria.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($subkriteria))
                            @method('PUT')
                        @endif
                        <div class="my-3 form-group">
                            <label for="kriteria" class="mb-2">Nama Kriteria</label>
                            <select class="form-select" id="kriteria" name="kriteria_id" required>
                                <option value="">Pilih Kriteria</option>
                                @if (isset($subkriteria))
                                    <option value="{{ $subkriteria->kriteria_id }}" selected>
                                        {{ $subkriteria->kriteria->name . ' - ' . $subkriteria->kriteria->code }} </option>
                                @endif
                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}"
                                        {{ old('kriteria_id', isset($subkriteria) ? $subkriteria->kriteria_id : '') == $kriteria->id ? 'selected' : '' }}>
                                        {{ $kriteria->name . ' - ' . $kriteria->code }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kriteria'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="name" class="mb-2">Nama Subkriteria</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name" name="name"
                                value="{{ old('name', isset($subkriteria) ? $subkriteria->name : '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="my-3 form-group">
                            <label for="bobot" class="mb-2">Bobot</label>
                            <input type="text" inputmode="decimal"
                                class="form-control {{ $errors->has('bobot') ? 'is-invalid' : '' }}" id="bobot"
                                name="bobot" value="{{ old('bobot', isset($subkriteria) ? $subkriteria->bobot : '') }}"
                                required>
                            @if ($errors->has('bobot'))
                                <div class="invalid-feedback">{{ $errors->first('bobot') }}</div>
                            @endif
                        </div>

                        <div class="my-3 form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($subkriteria) ? 'Edit' : 'Buat' }}
                            </button>
                            <a href="{{ route('subkriteria.index') }}" class="ml-2 btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
