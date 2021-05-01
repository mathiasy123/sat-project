@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!--- User profile section --->
<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <img src="{{ isset(auth('customer')->user()->gallery) ? url('storage/' . auth('customer')->user()->gallery) : asset('customer-assets/images/default-image.jpg') }}" class="img-fluid shadow rounded-circle" alt="gambar-profil" id="customer-gallery-preview" width="204" height="204">
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-12 col-md-8 col-lg-5">
        @if(session('alert-update-profile-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Ubah profil berhasil !</strong> {{ session('alert-update-profile-success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('alert-update-password-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Ubah profil berhasil !</strong> {{ session('alert-update-password-success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form action="{{ route('customers.shopping.profile.update', ['profile' => auth('customer')->user()->id]) }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('put')

            <div class="form-group">
                <label for="customerGallery" class="col-form-label">Gambar Profil</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="gallery" class="custom-file-input @error('gallery') is-invalid @enderror" id="customerGallery">
                        <label class="custom-file-label" for="bannerGallery">Choose file</label>
                    </div>
                </div>

                @error('gallery')<small id="galleryPath" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="customerName" class="col-form-label">Nama</label>
                <input type="text" name="name" value="{{ isset(auth('customer')->user()->name) ? auth('customer')->user()->name : old('name') }}" class="form-control @error('name') is-invalid @enderror" id="customerName" placeholder="Nama . . .">

                @error('name')<small id="customerName" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="customerPhone" class="col-form-label">Telepon</label>
                <input type="text" name="phone" value="{{ isset(auth('customer')->user()->phone) ? auth('customer')->user()->phone : old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="customerPhone" placeholder="Telepon . . .">

                @error('phone')<small id="customerPhone" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="customerAddress" class="col-form-label">Alamat</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5" id="customerAddress" placeholder="Alamat rumah . . .">{{ isset(auth('customer')->user()->address) ? auth('customer')->user()->address : old('address') }}</textarea>

                @error('address')<small id="customerAddress" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="customerEmail" class="col-form-label">Email</label>
                <input type="text" name="email" value="{{ isset(auth('customer')->user()->email) ? auth('customer')->user()->email : old('email') }}" class="form-control @error('email') is-invalid @enderror" id="customerEmail" placeholder="Email . . .">

                @error('email')<small id="customerEmail" class="form-text text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-block">Ubah Profil</button>
                </div>

                <div class="col-12">
                    <a href="{{ route('customers.shopping.profile.password') }}" class="btn btn-primary btn-block mt-3">Ubah Password</a>
                </div>
            </div>
          </form>
    </div>
</div>
<!--- End user profile section --->
@endsection

@push('after-script')
<script>
    $('#customerGallery').change(function(uploadedFile) {
        const fileName = uploadedFile.target.files[0].name
        $(this).next('.custom-file-label').html(fileName)

        const reader = new FileReader()
        reader.onload = function(galleryView) {
            $('#customer-gallery-preview').attr('src', galleryView.target.result)
        }
        reader.readAsDataURL(this.files[0])
    })
</script>
@endpush