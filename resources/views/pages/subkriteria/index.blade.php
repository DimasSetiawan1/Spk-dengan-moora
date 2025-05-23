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
        <div class="mb-3 d-flex justify-content-start">
            <a href="{{ route('subkriteria.create') }}" class="btn btn-primary">Tambah subkriteria</a>
        </div>
        <div class="table-responsive">
            <table id="tableSubkriteria" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Nama SubKriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($subkriterias->count() > 0)
                        @foreach ($subkriterias as $key => $subkriteria)
                            <tr>
                                <td>{{ $subkriteria->kriteria->name }}</td>
                                <td>{{ $subkriteria->name }}</td>
                                <td>{{ $subkriteria->bobot }}</td>
                                <td>
                                    <a href="{{ route('subkriteria.edit', $subkriteria->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('subkriteria.destroy', $subkriteria->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                            type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


    </main>
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
                $('#tableSubkriteria').DataTable({
                    responsive: true,
                    autoWidth: false,
                    columns: [{
                            data: 'nama kriteria'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'bobot'
                        },
                        {
                            data: 'aksi',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        emptyTable: "Data tidak ditemukan",
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
