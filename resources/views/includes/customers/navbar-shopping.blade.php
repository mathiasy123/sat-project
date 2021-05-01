<!-- Shopping dashboard navbar section -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand clearfix" href="#" id="profileButton" data-toggle="dropdown">
            <div class="dropdown">
                @isset(auth('customer')->user()->gallery)
                <img src="{{ asset('storage/' . auth('customer')->user()->gallery) }}" class="float-left mr-3 rounded-circle" width="40" height="40" alt="gambar-profil">
                @endisset

                @empty(auth('customer')->user()->gallery)
                <img src="{{ asset('customer-assets/images/default-image.jpg') }}" class="float-left mr-3 rounded-circle" width="40" height="40" alt="gambar-profil">
                @endempty

                @auth('customer')
                <div class="user-info float-right">
                    <small>{{ auth('customer')->user()->name }}</small><br>
                </div>
            
                <div class="dropdown-menu" aria-labelledby="profileButton">
                    <a class="dropdown-item" href="{{ route('customers.shopping.profile') }}">Lihat Profil</a>
                </div>
                @endauth
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavShopping" aria-controls="navbarNavShopping" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavShopping">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item {{ request()->routeIs('customers.shopping.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('customers.shopping.index') }}">Belanja Produk</a>
            </li>

            @auth('customer')
            <li class="nav-item {{ request()->routeIs('customers.shopping.transaction') ||request()->routeIs('customers.shopping.transaction.*')  ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('customers.shopping.transaction') }}">Riwayat Transaksi</a>
            </li>
            @endauth

            @auth('customer')
            <li class="nav-item">
                <a href="{{ route('customers.logout') }}" class="btn btn-danger px-3 ml-0 mt-3 mb-3 mt-lg-0 mb-lg-0 ml-lg-3 btn-block">Logout</a>
            </li>
            @endauth

            @guest('customer')
            <li class="nav-item">
                <a href="{{ route('customers.login.index') }}" class="btn btn-success px-3 ml-0 mt-3 mt-lg-0 ml-lg-2 btn-block">Login</a>
            </li>
            @endguest
          </ul>
        </div>
    </div>
</nav>
<!-- End shopping dashboard navbar section -->