@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <div class="container py-5 mt-5">
            <div class="mx-auto border-0 rounded shadow card w-50">
                <div class="p-3 text-center card-title">
                    <h1>{{ isset($supplier) ? 'Edit Supplier' : 'Tambah Supplier' }}</h1>

                </div>
                <div class="mx-auto card-body w-75">
                    <form action="{{ isset($supplier) ? route('supplier.update', $supplier->id) : route('supplier.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($supplier))
                            @method('PUT')
                        @endif
                        <div class="my-3 form-group">
                            <label for="name" class="mb-2">Nama Supplier</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name" name="name"
                                value="{{ old('name', isset($supplier) ? $supplier->name : '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="my-3 form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($supplier) ? 'Edit' : 'Buat' }}
                            </button>
                            <a href="{{ route('supplier.index') }}" class="ml-2 btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
