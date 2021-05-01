@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!--- User profile section --->
<div class="row justify-content-center mt-3">
    <div class="col-5">
        <form action="{{ route('customers.shopping.profile.password.update', ['profile' => auth('customer')->user()->id]) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="currentPassword" class="col-form-label">Password Sekarang</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" placeholder="Password Sekarang . . .">

                @error('current_password')<small id="currentPassword" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="newPassword" class="col-form-label">Password Baru</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" placeholder="Password Baru . . .">
                @error('password')<small id="password" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="passwordConfirmation" class="col-form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder="Konfirmasi Password . . .">
                @error('password_confirmation')<small id="passwordConfirmation" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Ubah Password</button>
              </div>
            </div>
          </form>
    </div>
</div>
<!--- End user profile section --->
@endsection