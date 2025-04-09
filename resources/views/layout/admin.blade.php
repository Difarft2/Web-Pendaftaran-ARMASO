<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.header')
    <title>@yield('title', 'Default Title')</title>
    @include('partials.css')
    <!-- CSS -->
</head>

<body id="page-top">
    @include('sweetalert::alert')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('storage/' . $settingweb->logo_website) }}" alt="Logo Website"
                        style="width: 45px; height: 45px;">
                </div>
                <div class="sidebar-brand-text mx-2">{{$settingweb->nama_website}}</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if (auth()->user()->role == 'superadmin')
            {{-- superadmin --}}
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Utama
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span>User Akun</span>
                </a>
                <div id="collapsePages4" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/dafatarakun">Daftar Akun</a>
                        <a class="collapse-item" href="/admin/password-requests">Requests Reset Password</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-users"></i>
                    <span>Peserta</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/peserta/semuadata">Semua Data</a>
                        <a class="collapse-item" href="/admin/peserta/online">Daftar Online</a>
                        <a class="collapse-item" href="/admin/peserta/offline">Daftar Offline</a>
                        <a class="collapse-item" href="/admin/peserta/kolektif">Daftar Kolektif</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-money-bills"></i>
                    <span>Pembayaran</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/tagihan">Tagihan</a>
                        <a class="collapse-item" href="/admin/pembayaran">Pembayaran</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Informasi
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/admin/persyaratan">
                    <i class="fa-solid fa-address-book"></i>
                    <span>Persyaratan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/pengumuman">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Pengumuman</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/kontakadmin">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Kontak Admin</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Setting
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-globe"></i>
                    <span>Website</span>
                </a>
                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/rekening">Info Pembayaran</a>
                        <a class="collapse-item" href="/admin/infolomba">Info Lomba</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/settingweb">
                    <i class="fa-solid fa-gear"></i>
                    <span>Apps</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        @endif
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown1" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 midle">{{ auth()->user()->name }}</span>
                                {{-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> --}}
                                <i class="fa-regular fa-circle-user img-profile rounded-circle"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown1">
                                <a class="dropdown-item" href="/admin/profil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('auth.logoutadmin')}}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
                    </div>
                    <!-- Content Row -->
                    @yield('content')
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('components.footer2')
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        @include('partials.scripts')
        <!-- JavaScript -->
</body>

</html>
<style>
.gradient-separator {
    height: 2px;
    background: gray;
    margin: 10px 0;
}
</style>
