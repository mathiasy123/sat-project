<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sembada Anugerah Teknik | {{ $title }}</title>

    {{-- Style CSS section --}}
    @include('includes.admins.style')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        {{-- Content section --}}
        @yield('auth-content')

    </div>

    {{-- Javascript section --}}
    @include('includes.admins.javascript')

</body>

</html>