<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sembada Anugerah Teknik | {{ $title }}</title>

    {{-- Style CSS section --}}
    @include('includes.customers.style')
</head>

<body>
    {{-- Navbar section --}}
    @include('includes.customers.navbar')

    {{-- Carousel section --}}
    @include('includes.customers.carousel')

    {{-- Content section --}}
    <main>
        @yield('customer-content')
    </main>
    
    {{-- Footer section --}}
    @include('includes.customers.footer')

    {{-- Javascript section --}}
    @stack('before-script')
    @include('includes.customers.javascript')
    @stack('after-script')
</body>

</html>