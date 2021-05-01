 <!-- Navbar section -->
 <nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ route('customers.landing.index') }}">
            <img src="{{ asset('customer-assets/images/logo.png') }}" width="100" height="40" alt="logo-sembada-anugerah-teknik">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto text-center font-weight-bold">
                <li class="nav-item {{ request()->routeIs('customers.landing.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.landing.index') }}">Beranda</a>
                </li>

                <li class="nav-item {{ request()->routeIs('customers.shopping.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.shopping.index') }}">Belanja</a>
                </li>

                <li class="nav-item {{ request()->routeIs('customers.landing.contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.landing.contact') }}">Kontak</a>
                </li>

                <li class="nav-item {{ request()->routeIs('customers.landing.testimony') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.landing.testimony') }}">Testimoni</a>
                </li>
 
                <li class="nav-item {{ request()->routeIs('customers.landing.about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.landing.about') }}">Tentang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End navbar section -->