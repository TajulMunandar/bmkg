<nav class="navbar-vertical navbar">
    <div class="nav-scroller flex-column d-flex justify-content-between">
        <!-- Brand logo -->
        <a class="navbar-brand text-center fw-bold" href="/dashboard" style="color: #DDE6ED">BM<span style="color: #64CCC5">KG</span></a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <i class="fa-solid fa-chart-pie me-3 nav-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/approve/*') ? 'active' : '' }}" href="{{ route('DashboardUmum.index') }}">
                    <i class="fa-solid fa-envelope me-3 nav-icon"></i>
                    Layanan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/user') ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <i class="fa-solid fa-user me-3 nav-icon"></i>
                    User
                </a>
            </li>
        </ul>


        <div class="nav-item mt-auto mb-5">
            <form action="/logout" method="post" class="d-grid">
                @csrf
                <button class="btn btn-outline-secondary d-block mx-4" style="color: #64CCC5">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2 nav-icon"></i>
                    Keluar
                </button>
            </form>
        </div>

    </div>
</nav>
