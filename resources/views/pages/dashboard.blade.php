@extends('layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <h2 class='mt-3'>Dashboard</h2>
        @if (session('success'))
            <div id='successAlert' class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mt-4 mb-3 row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-truck fa-3x text-primary me-3"></i>
                            <div>
                                <h5 class="card-title">Total Supplier</h5>
                                <p class="card-text fs-4">{{ $supplier }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list-ul fa-3x text-success me-3"></i>
                            <div>
                                <h5 class="card-title">Total Kriteria</h5>
                                <p class="card-text fs-4">{{ $kriteria }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-tasks fa-3x text-warning me-3"></i>
                            <div>
                                <h5 class="card-title">Total Subkriteria</h5>
                                <p class="card-text fs-4">{{ $subkriteria }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->
    @push('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('#successAlert').alert('close');
                }, 2000);
            });
        </script>
    @endpush
@endsection
