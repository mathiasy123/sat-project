@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Pencarian section -->
<div class="row">
    <div class="col-12 d-lg-flex justify-content-lg-end">
        <form action="{{ url()->current() }}" class="row">
            @csrf

            <div class="col-12 col-lg-5">
                <select name="category_id" class="form-control">
                    <option selected disabled>Pilih kategori produk</option>

                    @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option> 
                    @empty
                    <option disabled>---</option> 
                    @endforelse
                </select>
            </div>

            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                <input type="text" name="keyword" class="form-control" placeholder="Kata kunci . . .">
            </div>

            <div class="col-12 col-lg-3 mt-3 mt-lg-0">
                <button type="submit" class="btn btn-primary btn-block mb-2">Cari Produk</button>
            </div>
        </form>
    </div>
</div>
<!-- End pencarian section -->

<!-- Produk list section -->
<div class="row mt-3">
    @forelse ($products as $product)
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="card">

            @if($product->galleries()->exists())
            <img src="{{ url('storage/' . $product->galleries()->where('status', 1)->first()->gallery_path) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 35vh">
            @else
            <img src="https://via.placeholder.com/500" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 35vh">
            @endif

            <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <span class="badge badge-success p-2">{{ $product->category->name }}</span>
              <p class="card-text">{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</p>
              <a href="{{ route('customers.shopping.product.show', ['product' => $product->id]) }}" class="btn btn-primary btn-block">Detail Produk</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">-- Belum Ada Produk --</h3>
            </div>
        </div>
    </div>
    @endforelse
</div>
<!-- End produk list section -->
@endsection

@push('after-script')
<script>
    const uri = window.location.toString();

    if (uri.indexOf("?") > 0) {
        const clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
</script>
@endpush
