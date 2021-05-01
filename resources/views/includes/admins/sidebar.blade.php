<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admins.dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SAT Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admins.dashboard.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admins.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Transaksi
    </div>

    <!-- Nav item - order -->
    <li class="nav-item {{ request()->routeIs('admins.orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admins.orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan</span></a>
    </li>
    <!-- End nav item - order -->

     <!-- Nav item - payment receipt -->
     <li class="nav-item {{ request()->routeIs('admins.transactions.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admins.transactions.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Transaksi</span></a>
    </li>
    <!-- End nav item - payment receipt -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Manajemen
    </div>

    <!-- Nav item - category -->
    <li class="nav-item {{ request()->routeIs('admins.categories.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
            aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-fw fa-layer-group"></i>
            <span>Kategori</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admins.categories.index') ? 'active' : '' }}" href="{{ route('admins.categories.index') }}">Daftar Kategori</a>
                <a class="collapse-item {{ request()->routeIs('admins.categories.create') ? 'active' : '' }}" href="{{ route('admins.categories.create') }}">Tambah Kategori</a>
            </div>
        </div>
    </li>
    <!-- End nav item - category -->

    <!-- Nav item - product -->
    <li class="nav-item {{ request()->routeIs('admins.products.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
            aria-expanded="true" aria-controls="collapseProduct">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Produk</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admins.products.index') ? 'active' : '' }}" href="{{ route('admins.products.index') }}">Daftar Produk</a>
                <a class="collapse-item {{ request()->routeIs('admins.products.create') ? 'active' : '' }}" href="{{ route('admins.products.create') }}">Tambah Produk</a>
            </div>
        </div>
    </li>
    <!-- End nav item - product -->

     <!-- Nav item - product galleries -->
     <li class="nav-item {{ request()->routeIs('admins.product-galleries.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductGalleries"
            aria-expanded="true" aria-controls="collapseProductGalleries">
            <i class="fas fa-fw fa-images"></i>
            <span>Gambar Produk</span>
        </a>
        <div id="collapseProductGalleries" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admins.product-galleries.index') ? 'active' : '' }}" href="{{ route('admins.product-galleries.index') }}">Daftar Gambar Produk</a>
                <a class="collapse-item {{ request()->routeIs('admins.product-galleries.create') ? 'active' : '' }}" href="{{ route('admins.product-galleries.create') }}">Tambah Gambar Produk</a>
            </div>
        </div>
    </li>
    <!-- End nav item - product galleries -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Konten
    </div>

    <!-- Nav item - testimony -->
    <li class="nav-item {{ request()->routeIs('admins.testimonies.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTestimony"
            aria-expanded="true" aria-controls="collapseTestimony">
            <i class="fas fa-fw fa-quote-right"></i>
            <span>Testimoni</span>
        </a>
        <div id="collapseTestimony" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admins.testimonies.index') ? 'active' : '' }}" href="{{ route('admins.testimonies.index') }}">Daftar Testimoni</a>
                <a class="collapse-item {{ request()->routeIs('admins.testimonies.create') ? 'active' : '' }}" href="{{ route('admins.testimonies.create') }}">Tambah Testimoni</a>
            </div>
        </div>
    </li>
    <!-- End nav item - testimony -->

    <!-- Nav item - banner slide -->
    <li class="nav-item {{ request()->routeIs('admins.banners.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBannerSlide"
            aria-expanded="true" aria-controls="collapseBannerSlide">
            <i class="fas fa-fw fa-images"></i>
            <span>Banner</span>
        </a>
        <div id="collapseBannerSlide" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admins.banners.index') ? 'active' : '' }}" href="{{ route('admins.banners.index') }}">Daftar Banner</a>
                <a class="collapse-item {{ request()->routeIs('admins.banners.create') ? 'active' : '' }}" href="{{ route('admins.banners.create') }}">Tambah Banner</a>
            </div>
        </div>
    </li>
    <!-- End nav item - banner slide -->

    <!-- Nav item - description -->
    <li class="nav-item {{ request()->routeIs('admins.descriptions.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDescription"
            aria-expanded="true" aria-controls="collapseDescription">
            <i class="fas fa-fw fa-align-justify"></i>
            <span>Deskripsi</span>
        </a>
        <div id="collapseDescription" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admins.descriptions.index') ? 'active' : '' }}" href="{{ route('admins.descriptions.index') }}">Daftar Deskripsi</a>
                <a class="collapse-item {{ request()->routeIs('admins.descriptions.create') ? 'active' : '' }}" href="{{ route('admins.descriptions.create') }}">Tambah Deskripsi</a>
            </div>
        </div>
    </li>
    <!-- End nav item - description -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->