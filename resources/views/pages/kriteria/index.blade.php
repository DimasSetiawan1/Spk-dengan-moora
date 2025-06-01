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
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Tambah Kriteria</a>
        </div>
        <div class="table-responsive">
            <table id="tableKriteria" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col" data-orderable="true">Kode Kriteria</th>
                        <th scope="col" data-orderable="true">Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($kriterias->count() > 0)
                        @foreach ($kriterias as $key => $kriteria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kriteria->code }}</td>
                                <td>{{ $kriteria->name }}</td>
                                <td>{{ $kriteria->bobot }}</td>
                                <td>{{ $kriteria->keterangan == 1 ? 'benefit' : 'cost' }}</td>
                                <td>
                                    <a href="{{ route('kriteria.edit', $kriteria->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                            type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
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
                $('#tableKriteria').DataTable({
                    responsive: true,
                    autoWidth: false,
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
