@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Tambah Gambar Produk</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.product-galleries.store') }}" method="post" class="user" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gallery_path" class="custom-file-input @error('gallery_path') is-invalid @enderror" id="productGallery">
                                    <label class="custom-file-label" for="productGallery">Choose file</label>
                                </div>
                            </div>

                            @error('gallery_path')<small id="galleryPath" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <img src="https://via.placeholder.com/500" id="product-gallery-preview" class="img-thumbnail shadow" width="500">
                        </div>

                        <div class="form-group">
                            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" id="productName" >
                                <option selected disabled>Pilih produk . . .</option>

                                @forelse ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->code }} - {{ $product->name }}</option>
                                @empty
                                <option disabled>---</option>
                                @endforelse
                                
                            </select>

                            @error('product_id')<small id="productName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Tambah Gambar Produk
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
    $('#productGallery').change(function(uploadedFile) {
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

