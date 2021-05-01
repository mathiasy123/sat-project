@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail Pesanan PSN0001</h1>

<!-- Order detail section -->
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            @if($order->product->galleries()->exists())
            <img src="{{ url('storage/' . $order->product->galleries()->first()->gallery_path) }}" class="card-img-top" alt="{{ $order->product->name }}">
            @else
            <img src="https://placehold.it/500x500" class="card-img-top img-fluid" alt="{{ $order->product->name }}" style="height: 50vh">
            @endif

            <div class="card-body row">
                <div class="col-6 font-weight-bold">
                    <h5 class="card-title font-weight-bold">Nama Produk</h5>
                    <p>{{ $order->product->name }}</p>
                </div>
               
                <div class="col-6 font-weight-bold">
                    <h5 class="card-title font-weight-bold">Kategori Produk</h5>
                    <p>{{ $order->product->category->name }}</p>
                </div>

                <div class="col-6 font-weight-bold">
                    <h5 class="card-title font-weight-bold">Harga Produk</h5>
                    <p>{{ 'Rp. ' . number_format($order->product->price, 0, ',', '.') }}</p>
                </div>

                <div class="col-6 font-weight-bold">
                    <h5 class="card-title font-weight-bold">Stok Produk</h5>
                    <p>{{ $order->product->stock }}</p>
                </div>
            </div>

            <div class="card-footer">
                <h5 class="card-title font-weight-bold">Deskripsi Produk</h5>
                    <p>{{ $order->product->description }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-dark">Informasi Pelanggan</h5>
            </div>

            <div class="card-body">
                <h5 class="font-weight-bold">Nama</h5>
                <p>{{ $order->buyer->name }}</p>

                <h5 class="font-weight-bold mt-4">Email</h5>
                <p>{{ $order->buyer->email }}</p>

                <h5 class="font-weight-bold mt-4">Alamat</h5>
                <p>{{ $order->buyer->address }}</p>

                <h5 class="font-weight-bold mt-4">Jasa Pengiriman</h5>
                <p>{{ $order->courier }}</p>

                <h5 class="font-weight-bold mt-4">Jumlah</h5>
                <p>{{ $order->quantity }}</p>
            </div>
        </div>

        <a href="{{ route('admins.orders.index') }}" class="btn btn-secondary btn-block">Kembali</a>
    </div>
</div>
<!-- End order detail section -->
@endsection

