@extends('layouts.admins.auth-default')

@section('auth-content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-8 col-md-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                            </div>
                            
                            @if(session('login-invalid'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> {{ session('login-invalid') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form class="user" action="{{ route('admins.login') }}" method="post">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>  
@endsection
