@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Form login -->
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('{{asset('customer-assets/images/kenapa-kami.jpg')}}'); background-position: center; background-size: cover"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Daftar Akun Pelanggan</h1>
            </div>
                            
            <form class="user" action="{{ route('customers.register.account') }}" method="post">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-user @error('name') is-invalid @enderror"
                        id="name"
                        placeholder="Nama lengkap . . ." autocomplete="off">
                     @error('name')<small id="name" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control form-control-user @error('phone') is-invalid @enderror"
                        id="phone"
                        placeholder="Nomor telepon . . ." autocomplete="off">
                     @error('phone')<small id="phone" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>
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
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                        id="passwordConfirmation" placeholder="Konfirmasi password . . ." autocomplete="off">
                    @error('password_confirmation')<small id="passwordConfirmation" class="form-text text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Daftar
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
