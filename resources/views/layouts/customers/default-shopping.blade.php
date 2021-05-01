@extends('layouts.customers.default')
 
@section('customer-content')
<!-- Belanja section -->
<section class="p-5" id="layanan-section">
    <div class="container">
        {{-- Shopping dashboard navbar section --}}
        @include('includes.customers.navbar-shopping')

        <!-- Produk section -->
        <div class="card shadow mt-3">
            <div class="card-body">
                <div class="container">
                    @yield('customer-sub-content')
                </div>
            </div>
        </div>
        <!-- End produk section -->
    </div>
</section>
<!-- End belanja section -->
@endsection