@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Tambah Gambar Banner</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.banners.store') }}" method="post" class="user" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gallery_path" class="custom-file-input @error('gallery_path') is-invalid @enderror" id="bannerGallery">
                                    <label class="custom-file-label" for="bannerGallery">Choose file</label>
                                </div>
                            </div>

                            @error('gallery_path')<small id="galleryPath" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <img src="https://via.placeholder.com/500" alt="product-gallery" id="product-gallery-preview" class="img-thumbnail shadow" width="500">
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Tambah Gambar Banner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

@push('after-script')
<script>
    $('#bannerGallery').change(function(uploadedFile) {
        const fileName = uploadedFile.target.files[0].name
        $(this).next('.custom-file-label').html(fileName)

        const reader = new FileReader()
        reader.onload = function(galleryView) {
            $('#product-gallery-preview').attr('src', galleryView.target.result)
        }
        reader.readAsDataURL(this.files[0])
    })
</script>
@endpush

