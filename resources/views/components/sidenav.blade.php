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
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Utama
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/home/dataperserta">
            <i class="fa-solid fa-users"></i>
            <span>Data Diri</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/home/tagihan">
            <i class="fa-solid fa-money-bills"></i>
            <span>Tagihan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Informasi
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/home/persyaratanperserta">
            <i class="fa-solid fa-address-book"></i>
            <span>Persyaratan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/home/kontakadmin">
            <i class="fa-solid fa-user-tie"></i>
            <span>Kontak Admin</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
