@extends('layouts.main')
@section('content')
    <main class="container-fluid">

        <!-- Your main content goes here -->
        <div class="container mt-5 ">
            <div class="mb-3 row justify-content-between">
                <div class="col-md-6">
                    <h2>Halaman Perhitungan</h2>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('generate_pdf') }}">
                        <button class="btn btn-primary float-end">Cetak</button>
                    </a>
                </div>
            </div>
        </div>

        <br>
        <div class="h4">Matriks Keputusan</div>
        <div class="overflow-hidden table-responsive">
            <table class="table datatable-perhitungan table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Supplier</th>
                        @foreach ($kriterias as $kriteria)
                            <th scope="col">{{ $kriteria->name }}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplierId => $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $supplier->name }}
                            </td>
                            @foreach ($kriterias as $key => $value)
                                <td>{{ $matriks_keputusan[$key][$supplierId] }}</td>
                            @endforeach

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <br>
        <div class="h4">Matriks Normalisasi</div>
        <div class="overflow-hidden table-responsive">
            <table class="table datatable-perhitungan table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Supplier</th>
                        @foreach ($kriterias as $kriteria)
                            <th scope="col">{{ $kriteria->name }}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplierId => $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $supplier->name }}
                            </td>
                            @foreach ($kriterias as $key => $value)
                                <td>{{ $matriks_normalisasi[$key][$supplierId] }}</td>
                            @endforeach

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <br>
        <div class="h4">Matriks Perankingan</div>
        <div class="overflow-hidden table-responsive">
            <table class="table datatable-perhitungan table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Nilai</th>
                        {{-- <th></th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers->sortByDesc(function ($supplier) use ($nilais) {
            return $nilais[$supplier->id] ?? 0;
        }) as $supplier)
                        <tr class="{{ $loop->first ? 'table-success' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $supplier->name }}
                            </td>
                            <td>{{ $nilais[$supplier->id] }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <br>
            <div class="h4">Keterangan</div>
            <div class="mb-5 row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Berdasarkan hasil perhitungan menggunakan metode MOORA:</div>
                            <ol class="list-group list-group-numbered">
                                @foreach ($suppliers->sortByDesc(function ($supplier) use ($nilais) {
            return $nilais[$supplier->id] ?? 0;
        }) as $supplier)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $supplier->name }}</div>
                                            memperoleh nilai {{ $nilais[$supplier->id] ?? 0 }}
                                        </div>
                                        @if ($loop->first)
                                            <span class="badge bg-primary rounded-pill">Tertinggi</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ol>

                        </div>
                    </div>
                </div>
            </div>

    </main>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.datatable-perhitungan').DataTable({
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
