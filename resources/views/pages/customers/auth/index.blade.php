@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Form login -->
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('{{asset('customer-assets/images/kenapa-kami.jpg')}}'); background-position: center; background-size: cover"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Pelanggan</h1>
            </div>

            @if(session('alert-login-invalid'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('alert-login-invalid') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('alert-register-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('alert-register-success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('alert-forgot-password-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('alert-forgot-password-success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form class="user" action="{{ route('customers.login') }}" method="post">
                @csrf

                <div class="form-group">
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror"
                        id="email"
                        placeholder="Email . . ." autocomplete="off">
                     @error('email')<small id="email" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password" placeholder="Password . . ." autocomplete="off">
                    @error('password')<small id="password" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('customers.login.forgot-password') }}">Lupa Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{ route('customers.register') }}">Belum memiliki akun login?</a>
            </div>
        </div>
    </div>
</div>
<!-- End form login -->
@endsection
