<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                    <i class="fas fa-search"></i>
                </a>
            </li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @php
                    $avatar = auth()->user()->profileimage
                        ? asset(auth()->user()->profileimage)
                        : asset('uploads/profile.png');
                @endphp

                <img alt="Profile" src="{{ $avatar }}" class="rounded-circle mr-1" width="35" height="35">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="#" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Sidebar -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <!-- Brand Logos -->
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">KOLEJ TEKNOLOGI MAJU</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('uploads/profile.png') }}" alt="Logo" height="40" width="40">
            </a>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fire"></i> <span>General Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.student') }}">
                    <i class="fas fa-user-graduate"></i> <span>Student Registration</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.exams.index') }}">
                    <i class="fas fa-th"></i> <span>Examination Detail</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.notes.index') }}">
                    <i class="far fa-file-alt"></i> <span>Notes</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="credits.html">
                    <i class="fas fa-pencil-ruler"></i> <span>Credits</span>
                </a>
            </li>
        </ul>

        <!-- Sidebar Footer -->
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
