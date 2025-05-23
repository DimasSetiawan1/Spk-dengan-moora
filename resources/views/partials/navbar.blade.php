{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-nav ms-auto">
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i>
                {{ Auth::user()->name }}
                <small class="d-block">{{ Auth::user()->role }}</small>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">
                        <i class="bi bi-person me-2"></i>Profile
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li>
                        <button class="dropdown-item" type="submit">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign out
                        </button>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav> --}}

<nav class="px-4 py-0 navbar navbar-expand bg-light navbar-light sticky-top">
    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="mb-0 text-primary"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="flex-shrink-0 sidebar-toggler">
        <i class="fa fa-bars"></i>
    </a>

    <div class="ms-auto nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}</span>
        </a>
        <div class="m-0 border-0 dropdown-menu dropdown-menu-end bg-light rounded-0 rounded-bottom">
            <a href="{{ route('profile.edit', auth()->user()->id) }}" class="dropdown-item">My Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item" type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i>Sign out
                </button>
            </form>
        </div>
    </div>
</nav>
