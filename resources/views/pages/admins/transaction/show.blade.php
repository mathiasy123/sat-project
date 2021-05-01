@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail Pesanan PSN0001</h1>

<!-- Order detail section -->
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            @if($transaction->order->product->galleries()->exists())
            <img src="{{ url('storage/' . $transaction->order->product->galleries()->first()->gallery_path) }}" class="card-img-top" alt="{{ $transaction->order->product->name }}">
            @else
            <img src="https://via.placeholder.com/500" class="card-img-top img-fluid" alt="{{ $transaction->order->product->name }}" style="height: 50vh">
            @endif

            <div class="card-body row">
                <div class="col-6">
                    <h5 class="card-title font-weight-bold">Nama Produk</h5>
                    <p>{{ $transaction->order->product->name }}</p>
                </div>
               
                <div class="col-6">
                    <h5 class="card-title font-weight-bold">Kategori Produk</h5>
                    <p>{{ $transaction->order->product->category->name }}</p>
                </div>

                <div class="col-6">
                    <h5 class="card-title font-weight-bold">Harga Produk</h5>
                    <p>{{ 'Rp. ' . number_format($transaction->order->product->price, 0, ',', '.') }}</p>
                </div>

                <div class="col-6">
                    <h5 class="card-title font-weight-bold">Stok Produk</h5>
                    <p>{{ $transaction->order->product->stock }}</p>
                </div>
            </div>

            <div class="card-footer">
                <h5 class="card-title font-weight-bold">Deskripsi Produk</h5>
                    <p>{{ $transaction->order->product->description }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark">Informasi Pelanggan</h5>
                    </div>
        
                    <div class="card-body">
                        <h5 class="font-weight-bold">Nama</h5>
                        <p>{{ $transaction->order->buyer->name }}</p>
        
                        <h5 class="font-weight-bold mt-4">Email</h5>
                        <p>{{ $transaction->order->buyer->email }}</p>
        
                        <h5 class="font-weight-bold mt-4">Alamat</h5>
                        <p>{{ $transaction->order->buyer->address }}</p>
        
                        <h5 class="font-weight-bold mt-4">Jasa Pengiriman</h5>
                        <p>{{ $transaction->order->courier }}</p>
        
                        <h5 class="font-weight-bold mt-4">Jumlah</h5>
                        <p>{{ $transaction->order->quantity }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark">Informasi Pembayaran</h5>
                    </div>
        
                    <div class="card-body">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $transaction->order->product->name }} ({{ $transaction->order->quantity }} pcs)</td>
                                    <td>{{ 'Rp. ' . number_format($transaction->total, 0, ',', '.') }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">2</th>
                                    <td>Biaya Kirim ({{ $transaction->order->courier }})</td>
                                    <td>{{ 'Rp. ' . number_format($transaction->courier_cost, 0, ',', '.') }}</td>
                                </tr>

                                <tr class="font-weight-bold">
                                    <th class="text-center" scope="row" colspan="2">Total</th>
                                    <td>{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <h5 class="m-0 font-weight-bold text-dark">Bukti Pembayaran</h5>

                        <div class="mb-3">
                            
                            @if($transaction->payment_receipt)
                            <img src="{{ url('storage/' . $transaction->payment_receipt) }}" alt="payment-receipt" class="img-fluid mt-3 rounded shadow w-100" style="width: 100vh; height: 80vh">
                
                            @else
                            <img src="https://via.placeholder.com/500" alt="payment-receipt" class="img-fluid mt-3 rounded shadow w-100" style="width: 100vh; height: 80vh">
                            @endif 

                        </div>
                        
                        @if($transaction->status == 'PENDING')
                        <div class="text-right mt-3 mb-2">
                            <form action="{{ route('admins.transactions.failed', ['transaction' => $transaction->id]) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('put')

                                <button type="submit" class="btn btn-danger card-link">
                                    Tandai Gagal
                                </button>
                            </form>
                        </div>
                        @elseif($transaction->status == 'KIRIM')
                        <div class="text-right mt-3 mb-2">
                            <form action="{{ route('admins.transactions.failed', ['transaction' => $transaction->id]) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('put')

                                <button type="submit" class="btn btn-danger card-link">
                                    Tandai Gagal
                                </button>
                            </form>
                        </div>
                        @elseif($transaction->status == 'SUDAH BAYAR')
                        <div class="text-right mt-3 mb-2">
                            <form action="{{ route('admins.transactions.failed', ['transaction' => $transaction->id]) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('put')

                                <button type="submit" class="btn btn-danger card-link">
                                    Tandai Gagal
                                </button>
                            </form>

                            <form action="{{ route('admins.transactions.shipped', ['transaction' => $transaction->id]) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('put')
    
                                <button type="submit" class="btn btn-warning card-link">
                                    Tandai Kirim
                                </button>
                            </form>
                        </div>
                        @else
                        <span></span>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admins.transactions.index') }}" class="btn btn-secondary btn-block">Kembali</a>
    </div>
</div>
<!-- End order detail section -->
@endsection

