@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Product name section -->
<div class="row">
    <div class="col-12 d-lg-flex justify-content-center">
        <h1>{{ $product->name }}</h1>
    </div>
</div>
<!-- End product name section -->

<!-- Produk image section -->
<div class="row mt-3">

    @if($product->galleries->isEmpty())
    
    @for($i = 1; $i <= 3; $i++)
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card">
            <img src="https://via.placeholder.com/500" class="card-img-top" alt="{{ $product->name . '-' . $i }}" style="height: 45vh">

            <div class="card-body">
              <h5 class="card-title text-center">Gambar {{ $i }}</h5>
            </div>
        </div>
    </div>
    @endfor

    @else

    @foreach ($product->galleries->where('status', 1) as $gallery)

    <div class="col-12 col-lg-4 mb-4">
        <div class="card">
            <img src="{{ url('storage/' . $gallery->gallery_path) }}" class="card-img-top" alt="{{ $product->name . '-' . $loop->iteration }}" style="height: 45vh">

            <div class="card-body">
              <h5 class="card-title text-center">Gambar {{ $loop->iteration }}</h5>
            </div>
        </div>
    </div>    
    
    @endforeach

    @endif
</div>
<!-- End produk image section -->

<!-- Produk image section -->
<div class="row mt-3">
    <div class="col-12 col-md-6 col-lg-6 mb-4 text-center text-md-left">
        <h3>Deskripsi</h3>
        <p>{{ $product->description }}</p>
    </div>

    <div class="col-12 col-md-6 col-lg-6 mb-4 text-center text-md-left">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <h3>Kategori</h3>
                <p>{{ $product->category->name }}</p>
            </div>   
    
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <h3>Harga</h3>
                <p>{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</p>
            </div>
        
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <h3>Stok</h3>
                <p>{{ $product->stock }}</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <a href="{{ route('customers.shopping.order', ['product' => $product->id]) }}" class="btn btn-primary btn-block">
                    Pesan Produk
                </a>
            </div>

            <div class="col-12">
                <a href="{{ route('customers.shopping.index') }}" class="btn btn-danger btn-block mt-3">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End produk image section -->
@endsection