@extends('layouts.main')
@section('content')
    <div class="container-fluid">
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
        <div class="mb-3 d-flex justify-content-start">
            <a href="{{ route('supplier.create') }}" class="btn btn-primary">Daftar Supplier</a>
        </div>
        <div class="table-responsive">
            <table id="tableSupplier" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $key => $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $supplier->code }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>
                                <a href="{{ route('supplier.edit', $supplier->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                        type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(async () => {
                    await new Promise(resolve => {
                        $("#successAlert, #errorAlert").fadeOut('slow', function() {
                            $(this).remove();
                            resolve();
                        });
                    });
                }, 2000);
                $('#tableSupplier').DataTable({
                    responsive: true,
                    autoWidth: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        zeroRecords: "Tidak ada data yang ditemukan",
                        info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                        infoEmpty: "Tidak ada data yang tersedia",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                    }
                });
            });
        </script>
    @endpush
@endsection
