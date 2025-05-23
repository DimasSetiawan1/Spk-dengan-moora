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
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
        </div>
        <div class="overflow-hidden table-responsive">
            <table id="users" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        @if ($user->role != 'superadmin')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                            type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
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
                $('#users').DataTable({
                    responsive: true,
                    autoWidth: false,
                    scrollX: false,
                    columnDefs: [{
                            width: '5%',
                            targets: 0
                        }, // No
                        {
                            width: '25%',
                            targets: 1
                        }, // Nama Supplier
                        {
                            width: '25%',
                            targets: 2
                        }, // Nama Supplier
                        {
                            width: '10%',
                            targets: 3
                        }, // Nama Supplier
                        {
                            width: '15%',
                            targets: 4
                        }, // Aksi
                    ],
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
