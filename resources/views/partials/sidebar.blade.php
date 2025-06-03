@php
    $inputDataActive = Request::is('kriteria*', 'subkriteria*', 'supplier*', 'penilaian*');
    $settingsActive = Request::is('lists/users*');
@endphp


<div class="pb-3 sidebar pe-4">
    <nav class="navbar bg-light navbar-light">
        <a href="/" class="mx-4 mb-3 navbar-brand">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Perusahaan" style="max-height: 35px;">
        </a>
        <div class="mb-4 d-flex align-items-center ms-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets/icons/user.svg') }}" alt="User Avatar"
                    style="width: 40px; height: 40px;">
                <div
                    class="bottom-0 p-1 border border-2 border-white bg-success rounded-circle position-absolute end-0">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>{{ Auth::user()->role }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $inputDataActive ? 'active' : '' }}"
                    data-bs-toggle="dropdown">
                    <i class="fa fa-database me-2"></i>Input Data
                </a>
                <div class="bg-transparent border-0 dropdown-menu {{ $inputDataActive ? 'show' : '' }}">
                    @canany(['superadmin', 'admin'])
                        <a href="{{ route('kriteria.index') }}"
                            class="dropdown-item {{ Request::is('kriteria*') ? 'active' : '' }}">
                            <i class="fa fa-list-ul me-2"></i>Data Kriteria
                        </a>
                    @endcan
                    <a href="{{ route('subkriteria.index') }}"
                        class="dropdown-item {{ Request::is('subkriteria*') ? 'active' : '' }}">
                        <i class="fa fa-list-ol me-2"></i>Data Subkriteria
                    </a>
                    <a href="{{ route('supplier.index') }}"
                        class="dropdown-item {{ Request::is('supplier*') ? 'active' : '' }}">
                        <i class="fa fa-truck me-2"></i>Data Supplier
                    </a>
                    @can(['superadmin', 'admin'])
                        <a href="{{ route('penilaian.index') }}"
                            class="dropdown-item {{ Request::is('penilaian*') ? 'active' : '' }}">
                            <i class="fa fa-star me-2"></i>Data Penilaian
                        </a>
                    @endcan
                </div>
            </div>
            @can('superadmin')
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle  {{ $settingsActive ? ' active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-cog me-2"></i>Settings
                    </a>
                    <div class="bg-transparent border-0 dropdown-menu  {{ $settingsActive ? ' show' : '' }}">
                        <a href="{{ route('users.index') }}" class="dropdown-item {{ $settingsActive ? 'active' : '' }} ">
                            <i class="fa fa-users me-2"></i>Data Users
                        </a>
                    </div>
                </div>
            @endcan
            <a href="{{ route('perhitungan.index') }}"
                class="nav-item nav-link {{ Request::is('perhitungan') ? 'active' : '' }}">
                <i class="fa fa-calculator me-2"></i>Perhitungan
            </a>
        </div>
    </nav>
</div>
{{-- <nav id="sidebarMenu" class="mx-auto col-md-2 col-lg-2 d-md-block bg-dark sidebar collapse"
    style="height: calc(100vh - 48px);">
    <a href="/" class="pb-3 d-flex link-body-emphasis text-decoration-none">
        <img src="{{ asset('assets/images/logo.png') }}" class='mx-auto img' alt="Logo Perusahaan"
            style="max-height: 35px;border-radius: 10px">
    </a>
    <div class="pt-3 ">
        <ul class="list-unstyled ps-0">
            <li class="mb-2 nav-item">
                <a href={{ route('dashboard') }}
                    class="nav-link rounded d-inline-flex text-decoration-none w-100 px-3 py-2 {{ Request::is('dashboard') ? 'active bg-primary text-white' : 'text-white' }}"
                    aria-current="page">
                    <i class="bi bi-house-door me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="mb-2">
                <button
                    class="border-0 mb-2 rounded btn btn-toggle d-flex align-items-center w-100 px-3 py-2 {{ $inputDataActive ? 'active bg-primary text-white' : 'text-white' }}"
                    data-bs-toggle="collapse" data-bs-target="#input-data"
                    aria-expanded="{{ $inputDataActive ? 'true' : 'false' }}">
                    <i class="bi bi-input-cursor-text me-2"></i>
                    Input Data
                </button>
                <div class="collapse {{ $inputDataActive ? 'show' : '' }}" id="input-data">
                    <ul class="btn-toggle-nav list-unstyled fw-normal overflow-hide small ps-3">
                        @can('is_admin')
                            <li><a href="{{ route('kriteria.index') }}"
                                    class="rounded mb-2 d-block px-3 py-2 overflow-hide text-decoration-none {{ Request::is('kriteria*') ? 'active bg-primary text-white' : 'text-white hover-primary' }}">
                                    <i class="bi bi-list-check me-2"></i>
                                    Data Kriteria
                                </a>
                            </li>
                            <li><a href="{{ route('subkriteria.index') }}"
                                    class="rounded mb-2 d-block px-3 py-2 overflow-hide text-decoration-none {{ Request::is('subkriteria*') ? 'active bg-primary text-white' : 'text-white hover-primary' }}">
                                    <i class="bi bi-list-nested me-2"></i>
                                    Data Subkriteria
                                </a></li>
                        @endcan
                        <li><a href="{{ route('supplier.index') }}"
                                class="rounded mb-2 d-block px-3 py-2 overflow-hide text-decoration-none {{ Request::is('supplier*') ? 'active bg-primary text-white' : 'text-white hover-primary' }}">
                                <i class="bi bi-building me-2"></i>
                                Data Supplier
                            </a>
                        </li>
                        <li><a href="{{ route('penilaian.index') }}"
                                class="rounded mb-2 d-block px-3 py-2 overflow-hide text-decoration-none {{ Request::is('penilaian*') ? 'active bg-primary text-white' : 'text-white hover-primary' }}">
                                <i class="bi bi-clipboard-data me-2"></i>
                                Data Penilaian
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @can('is_admin')
                <li class="mb-2">
                    <button
                        class="border-0 mb-2 rounded btn btn-toggle d-flex align-items-center w-100 px-3 py-2 {{ $settingsActive ? 'active bg-primary text-white' : 'text-white' }}"
                        data-bs-toggle="collapse" data-bs-target="#settings"
                        aria-expanded="{{ $settingsActive ? 'true' : 'false' }}">
                        <i class="bi bi-gear me-2"></i>
                        Settings
                    </button>
                    <div class="collapse {{ $settingsActive ? 'show' : '' }}" id="settings">
                        <ul class="btn-toggle-nav list-unstyled fw-normal overflow-hide small ps-3">
                            <li><a href="{{ route('users.index') }}"
                                    class="rounded mb-2 d-block px-3 py-2 overflow-hide text-decoration-none {{ $settingsActive ? 'active bg-primary text-white' : 'text-white hover-primary' }}">
                                    <i class="bi bi-people me-2"></i>
                                    Data Users
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endcan

            <li class="mb-2 nav-item">
                <a href={{ route('perhitungan.index') }}
                    class="nav-link rounded d-inline-flex text-decoration-none w-100 px-3 py-2 {{ Request::is('perhitungan') ? 'active bg-primary text-white' : 'text-white' }}"
                    aria-current="page">
                    <i class="bi bi-calculator me-2"></i>
                    Perhitungan
                </a>
            </li>
        </ul>
    </div>
</nav> --}}
