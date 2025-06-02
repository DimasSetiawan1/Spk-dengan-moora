@extends('layouts.main')
@section('content')
    <main class="container-fluid">
        <!-- Your main content goes here -->
        <h2>Daftar Data Penilaian</h2>
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
            <a href="{{ route('penilaian.create') }}" class="btn btn-primary">Tambah Penilaian</a>
        </div>
        <div class="table-responsive">
            <table id="tablePenilian" class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nama Supplier</th>
                        @foreach ($kriterias as $kriteria)
                            @if ($kriteria->subkriterias->count() > 0)
                                <th scope="col">{{ $kriteria->name }}</th>
                            @endif
                        @endforeach
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>
                                {{ $supplier->name }}
                            </td>
                            @foreach ($supplier->kriterias as $index => $kriteria)
                                <td>{{ \App\Models\Subkriteria::find($kriteria->pivot->subkriteria_id)->name }}</td>
                                {{-- <td>{{ $kriteria->pivot->subkriteria_id }}</td> --}}
                            @endforeach

                            <td>
                                <a href="{{ route('penilaian.edit', $supplier->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('penilaian.destroy', $supplier->id) }}" method="POST"
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
                $('#tablePenilian').DataTable({
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
