@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Checkout section -->
<div class="row">
    <div class="col-12 col-lg-6 mb-4">
        <div class="card">
            @if($transaction->order->product->galleries()->exists())
            <img src="{{ url('storage/' . $transaction->order->product->galleries()->first()->gallery_path) }}" class="card-img-top" alt="{{ $transaction->order->product->name }}">
            @else
            <img src="https://via.placeholder.com/500" class="card-img-top img-fluid" alt="{{ $transaction->order->product->name }}" style="height: 50vh">
            @endif

            <div class="card-body row">
                <div class="col-6">
                    <h5 class="card-title">Nama Produk</h5>
                    <p>{{ $transaction->order->product->name }}</p>
                </div>
               
                <div class="col-6">
                    <h5 class="card-title">Kategori Produk</h5>
                    <p>{{ $transaction->order->product->category->name }}</p>
                </div>

                <div class="col-6">
                    <h5 class="card-title">Harga Produk</h5>
                    <p>{{ 'Rp. ' . number_format($transaction->order->product->price, 0, ',', '.') }}</p>
                </div>

                <div class="col-6">
                    <h5 class="card-title">Stok Produk</h5>
                    <p>{{ $transaction->order->product->stock }}</p>
                </div>
            </div>

            <div class="card-footer">
                <h5 class="card-title">Deskripsi Produk</h5>
                <p>{{ $transaction->order->product->description }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark">Informasi Pemesan</h5>
                    </div>

                    <div class="card-body">
                        <h5>Nama</h5>
                        <p>{{ $transaction->order->buyer->name }}</p>
        
                        <h5>Email</h5>
                        <p>{{ $transaction->order->buyer->email }}</p>

                        <h5>Nomor Telepon</h5>
                        <p>{{ $transaction->order->buyer->phone }}</p>
        
                        <h5>Alamat</h5>
                        <p>{{ $transaction->order->buyer->address }}</p>
        
                        <h5>Jasa Pengiriman</h5>
                        <p>{{ $transaction->order->courier }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark">Informasi Pembayaran</h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-sm text-nowrap">
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
                                    <td>{{ $transaction->order->product->name }} ({{ $transaction->order->quantity }}pcs)</td>
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

                        @if($transaction->status == 'PENDING')
                        <small class="text-danger font-italic">*Untuk total biaya dapat transfer ke rekening Berikut:</small><br>
                        <small class="text-danger font-italic">BCA: 12345678910</small><br>
                        <small class="text-danger font-italic">Mandiri: 12345678910</small><br>
                        <small class="text-danger font-italic">*Upload bukti transfer dibawah berikut agar pesanan Anda dapat diproses</small><br>

                        <form action="{{ route('customers.shopping.transaction.payment', ['transaction' => $transaction->id]) }}" method="post" class="mt-4" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @error('buyer_name')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Peringatan!</strong> {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            <input type="hidden" name="buyer_name" value="{{ $transaction->order->buyer->name }}">

                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="payment_receipt" class="custom-file-input @error('payment_receipt') is-invalid @enderror" id="paymentReceiptGallery">
                                    <label class="custom-file-label" for="paymentReceiptGallery">Choose file</label>
                                </div>
                            </div>

                            @error('payment_receipt')<small id="paymentReceipt" class="form-text text-danger mb-3">{{ $message }}</small>@enderror

                            <div class="form-group">
                                <img src="https://via.placeholder.com/500" alt="payment-receipt-gallery" id="payment-receipt-gallery-preview" class="img-thumbnail shadow" width="500">
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Bayar</button>
                        </form>

                        <form action="{{ route('customers.shopping.transaction.cancel', ['transaction' => $transaction->id]) }}" method="post">
                            @csrf
                            @method('put')

                            <button type="submit" class="btn btn-danger btn-block mt-2 mb-2">Batalkan Pesanan</button>
                        </form>
                        

                        @elseif($transaction->status == 'KIRIM' || $transaction->status == 'SUKSES' || $transaction->status == 'SUDAH BAYAR')
                        <div class="mb-3">
                            <img src="{{ url('storage/' . $transaction->payment_receipt) }}" class="img-fluid mt-3 shadow" alt="{{ $transaction->order->product->name }}" style="width: 100vh; height: 80vh">
                        </div>
                       
                        <small class="text-danger font-italic">*Pesanan ini sudah dibayar</small><br>

                        @else
                        <small class="text-danger font-italic">*Pesanan ini sudah dibatalkan</small><br>

                        @endif

                        @if(session('alert-transaction-cancel-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('alert-transaction-cancel-success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <a href="{{ route('customers.shopping.transaction') }}" class="btn btn-secondary btn-block mt-2">Kembali</a>
                    </div?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End checkout section -->
@endsection

@push('after-script')
<script>
    $('#paymentReceiptGallery').change(function(uploadedFile) {
        const fileName = uploadedFile.target.files[0].name
        $(this).next('.custom-file-label').html(fileName)

        const reader = new FileReader()
        reader.onload = function(galleryView) {
            $('#payment-receipt-gallery-preview').attr('src', galleryView.target.result)
        }
        reader.readAsDataURL(this.files[0])
    })
</script>
@endpush