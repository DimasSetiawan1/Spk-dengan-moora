@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <div class="container py-5 mt-5">
            <div class="mx-auto border-0 rounded shadow card w-50">
                <div class="p-3 text-center card-title">
                    <h1>{{ $title }}</h1>
                    @if (!isset($add))
                        <h3>Supplier {{ $supplier->name }}</h3>
                    @endif
                </div>
                <div class="px-5 mx-auto card-body w-75">
                    <form action="{{ isset($add) ? route('penilaian.store') : route('penilaian.update', $supplier->id) }}"
                        method="POST">
                        @csrf
                        @isset($add)
                            <div class="my-3 form-group">
                                <label for="supplier_id" class="mb-2">Supplier</label>
                                <select class="form-select {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"
                                    name="supplier_id" id="supplier_id" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_id'))
                                    <div class="invalid-feedback">{{ $errors->first('supplier_id') }}</div>
                                @endif
                            </div>
                        @endisset
                        @if (!isset($add))
                            @method('PUT')
                        @endif
                        @foreach ($kriterias as $kriteria)
                            @if ($kriteria->subkriterias->count() > 0)
                                <div class="my-3 form-group">
                                    <label for="bobot" class="mb-2">{{ $kriteria->name }}</label>
                                    <select class="form-select {{ $errors->has('bobot') ? 'is-invalid' : '' }}"
                                        name="bobot[{{ $kriteria->id }}]" id="bobot" required>
                                        @php
                                            $penilaian = [];
                                            $data = $supplier->kriterias->find($kriteria->id);
                                            if ($data) {
                                                $penilaian[$kriteria->id] = $data->pivot->bobot;
                                            } else {
                                                $penilaian[$kriteria->id] = 0;
                                            }
                                        @endphp
                                        <option value="">-- Pilih Salah Satu --</option>
                                        @foreach ($kriteria->subkriterias as $subkriterias)
                                            <option value="{{ $subkriterias->bobot }}"
                                                {{ old('bobot', $penilaian[$kriteria->id]) == $subkriterias->bobot ? 'selected' : '' }}>
                                                {{ $subkriterias->name }} - {{ $subkriterias->bobot }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('bobot'))
                                        <div class="invalid-feedback">{{ $errors->first('bobot') }}</div>
                                    @endif
                                </div>
                            @endif
                        @endforeach



                        <div class="my-3 form-group">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('penilaian.index') }}" class="ml-2 btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
