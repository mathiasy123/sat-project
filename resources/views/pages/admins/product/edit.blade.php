@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Ubah Produk</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.products.update', ['product' => $product->id]) }}" method="post" class="user">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <input type="text" value="{{ $product->code }}" class="form-control form-control-user" id="productCode"
                                placeholder="Kode produk . . ." disabled>
                            <small id="productCode" class="form-text text-muted">Kode produk digenerate otomatis</small>
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name') ? old('name') : $product->name }}" class="form-control form-control-user @error('name') is-invalid @enderror" id="productName"
                                placeholder="Nama produk  . . ." autocomplete="off">

                            @error('name')<small id="productName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="price" value="{{ old('price') ? old('price') : $product->price }} " class="form-control form-control-user @error('price') is-invalid @enderror" id="productDescription" placeholder="Harga produk . . ." autocomplete="off">

                            @error('price')<small id="productDescription" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="productDescription" placeholder="Deskripsi produk . . ." rows="5" autocomplete="off">{{ old('description') ? old('description') : $product->description }}</textarea>

                            @error('description')<small id="productDescription" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="weight" value="{{ old('weight') ? old('weight') : $product->weight }}" class="form-control form-control-user @error('weight') is-invalid @enderror" id="productPrice"
                                placeholder="Berat produk (gram) . . ." autocomplete="off">

                            @error('weight')<small id="productPrice" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="stock" value="{{ old('stock') ? old('stock') : $product->stock }}" class="form-control form-control-user @error('stock') is-invalid @enderror" id="productStock"
                                placeholder="Stok produk  . . ." autocomplete="off">

                            @error('stock')<small id="productStock" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="categoryName" >
                                <option selected disabled>Pilih kategori produk . . .</option>

                                @forelse ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->code }} - {{ $category->name }}</option>
                                @empty
                                <option disabled>---</option>
                                @endforelse
                            </select>

                            @error('category_id')<small id="categoryName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Ubah Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

