@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Form login -->
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('{{asset('customer-assets/images/kenapa-kami.jpg')}}'); background-position: center; background-size: cover"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Lupa Password Pelanggan</h1>
            </div>

            @if(session('alert-email-invalid'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('alert-email-invalid') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
                            
            <form class="user" action="{{ route('customers.forgot-password') }}" method="post">
                @csrf

                <div class="form-group">
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror"
                        id="email"
                        placeholder="Email . . ." autocomplete="off">
                     @error('email')<small id="email" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password" placeholder="Password baru . . ." autocomplete="off">
                    @error('password')<small id="password" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
                
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                        id="passwordConfirmation" placeholder="Konfirmasi password . . ." autocomplete="off">
                    @error('password_confirmation')<small id="passwordConfirmation" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Ubah Password
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('customers.login.index') }}">Sudah punya akun login?</a>
            </div>
        </div>
    </div>
</div>
<!-- End form login -->
@endsection
