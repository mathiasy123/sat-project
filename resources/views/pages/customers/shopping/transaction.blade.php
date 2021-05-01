@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')

@if(session('alert-payment-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-payment-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-update-transaction-status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-update-transaction-status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Transaction table section -->
<div class="row">
    <div class="col-12">
        <p class="text-danger text-center text-lg-left font-weight-bold">* Harap untuk menekan tombol "Selesaikan" jika produk/barang sudah Anda terima dengan benar.</p>

        <div class="table-responsive">
        
            <table class="table table-hover text-center w-100 text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
    
                <tbody>
    
                    @forelse ($transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $transaction->order->created_at }}</td>
                        <td>{{ $transaction->order->product->name }}</td>
                        <td>
                            @if($transaction->status == 'GAGAL')
                            <span class="badge badge-secondary p-2 w-100">Dibatalkan
                            @elseif($transaction->status == 'SUKSES')
                            <span class="badge badge-success p-2 w-100">Sukses</span>
                            @elseif($transaction->status == 'PENDING')
                            <span class="badge badge-danger p-2 w-100">Belum Bayar</span>
                            @elseif($transaction->status == 'SUDAH BAYAR')
                            <span class="badge badge-info p-2 w-100">Sudah Bayar</span>
                            @else
                            <span class="badge badge-warning p-2 w-100">Proses Kirim</span>
                            @endif
                            </span>
                        </td>
                        <td>
                            @if($transaction->status == 'GAGAL' || $transaction->status == 'SUKSES')
                            <a href="{{ route('customers.shopping.transaction.detail', ['transaction' => $transaction->id]) }}" class="btn btn-info">
                                Lihat Pesanan
                            </a>
                            @elseif($transaction->status == 'PENDING')
                            <a href="{{ route('customers.shopping.transaction.detail', ['transaction' => $transaction->id]) }}" class="btn btn-danger">
                                Bayar Pesanan
                            </a>
                            @else
                            <a href="{{ route('customers.shopping.transaction.detail', ['transaction' => $transaction->id]) }}" class="btn btn-info">
                                Lihat Pesanan
                            </a>    

                            <form action="{{ route('customers.shopping.transaction.succeed', ['transaction' => $transaction->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('put')
                                
                                <button type="submit" class="btn btn-success">
                                    Selesaikan 
                                </button>                                
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <h3 class="text-center">--- Belum Ada Transaksi ---</h3>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End transaction table section -->
@endsection