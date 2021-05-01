@extends('layouts.customers.default-shopping')
 
@section('customer-sub-content')
<!-- Checkout section -->
<div class="row">
    <!-- Detail product section -->
    <div class="col-12 col-md-6 col-lg-6 mb-4">
        <div class="card">
            @if($product->galleries()->exists())
            <img src="{{ url('storage/' . $product->galleries()->first()->gallery_path) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 50vh">
            @else
            <img src="https://via.placeholder.com/500" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 50vh">
            @endif

            <div class="card-body row">
                <div class="col-6">
                    <h5 class="card-title">Nama Produk</h5>
                    <p>{{ $product->name }}</p>
                </div>
               
                <div class="col-6">
                    <h5 class="card-title">Kategori Produk</h5>
                    <p>{{ $product->category->name }}</p>
                </div>

                <div class="col-6">
                    <h5 class="card-title">Harga Produk</h5>
                    <p>{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="col-6">
                    <h5 class="card-title">Stok Produk</h5>
                    <p>{{ $product->stock }}</p>
                </div>
            </div>

            <div class="card-footer">
                <h5 class="card-title">Deskripsi Produk</h5>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
     <!-- End detail product section -->

    <div class="col-12 col-md-6 col-lg-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Pemesanan Produk</h5>
                <small class="text-danger form-text mb-4">* Mohon untuk mengisi data sesuai dengan pemesanan Anda dengan valid dan lengkap</small>
                
                @if(session('alert-store-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Pemesanan produk berhasil !</strong> {{ session('alert-store-success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @error('order.product_id')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Peringatan !</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror

                @error('price')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Peringatan !</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror

                @error('province_origin')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Peringatan !</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror

                @error('city_origin')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Peringatan !</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror

                @error('courier_cost')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Peringatan !</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror

                <form action="{{ route('customers.shopping.order.store') }}" method="post">
                    @csrf

                    <input type="hidden" name="order[product_id]" value="{{ $product->id }}">

                    <input type="hidden" name="price" value="{{ $product->price }}">

                    <input type="hidden" name="province_origin" value="6">

                    <input type="hidden" name="city_origin" value="152">

                    <div class="form-group">
                        <label for="buyerName">Nama Lengkap</label>
                        <input type="text" name="buyer[name]" value="{{ isset(auth('customer')->user()->name) ? auth('customer')->user()->name : old('buyer.name') }}" class="form-control @error('buyer.name') is-invalid @enderror" id="buyerName" autocomplete="off">

                        @error('buyer.name')<small id="buyerName" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="buyerPhone">Nomor Telepon</label>
                        <input type="text" name="buyer[phone]" value="{{ isset(auth('customer')->user()->phone) ? auth('customer')->user()->phone : old('buyer.phone') }}" class="form-control @error('buyer.phone') is-invalid @enderror" id="buyerPhone" autocomplete="off">

                        @error('buyer.phone')<small id="buyerPhone" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="buyerAddress">Alamat</label>
                        <textarea name="buyer[address]" class="form-control @error('buyer.address') is-invalid @enderror" id="buyerAddress" rows="5">{{ isset(auth('customer')->user()->address) ? auth('customer')->user()->address : old("buyer.address") }}</textarea>

                        @error('buyer.address')<small id="buyerAddress" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="buyerEmail">Email</label>
                        <input type="text" name="buyer[email]" value="{{ isset(auth('customer')->user()->email) ? auth('customer')->user()->email : old('buyer.email') }}" class="form-control @error('buyer.email') is-invalid @enderror" id="buyerEmail" autocomplete="off">

                        @error('buyer.email')<small id="buyerEmail" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="orderQuantity">Jumlah</label>
                        <input type="text" name="order[quantity]" value="{{ old('order.quantity') }}" class="form-control @error('order.quantity') is-invalid @enderror" id="orderQuantity" autocomplete="off">

                        @error('order.quantity')<small id="orderQuantity" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="orderWeight">Berat (Gram)</label>
                        <input type="text" name="weight" value="{{ $product->weight }}" class="form-control @error('weight') is-invalid @enderror" id="orderWeight" disabled>

                        @error('weight')<small id="orderWeight" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="provinceDestination">Provinsi Tujuan</label>
                        <select name="province_id" id="provinceDestination" class="form-control @error('province_id') is-invalid @enderror">
                            <option selected disabled>Pilih provinsi tujuan . . .</option>
                            
                            @foreach ($provinces as $province)
                            <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                            @endforeach
                        </select>

                        @error('province_id')<small id="provinceDestination" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="cityDestination">Kota Tujuan</label>
                        <select name="city_id" id="cityDestination" class="form-control @error('city_id') is-invalid @enderror">
                            <option selected disabled>Pilih kota tujuan . . .</option>
                        </select>

                        @error('city_id')<small id="cityDestination" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="courierName">Jasa Ekspedisi</label>
                        <select name="order[courier]" id="courierName" class="form-control @error('order.courier') is-invalid @enderror">
                            <option selected disabled>Pilih jasa ekspedisi . . .</option>
                            <option value="jne" {{ (old('order.courier') == 'jne') ? 'selected' : '' }}>JNE</option>
                            <option value="pos" {{ (old('order.courier') == 'pos') ? 'selected' : '' }}>POS INDONESIA</option>
                            <option value="tiki" {{ (old('order.courier') == 'tiki') ? 'selected' : '' }}>TIKI</option>
                        </select>

                        @error('order.courier')<small id="courierName" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group">
                        <label for="courierCost">Layanan Ekspedisi</label>
                        <select name="transaction[courier_cost]" id="courierCost" class="form-control @error('transaction.courier_cost') is-invalid @enderror">
                            <option selected disabled>Pilih layanan ekspedisi . . .</option>
                        </select>

                        @error('transaction.courier_cost')<small id="courierCost" class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>

                    <button type="submit" class="btn btn-block btn-primary mt-5">Pesan Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End checkout section -->
@endsection

@push('after-script')
<script>
$(document).ready(function () {
    $(`input[name="order[quantity]"]`).on('change', function() {
        let quantityValue = $(this).val()
        let totalWeight = quantityValue * $('input[name="weight"]').val()

        $('input[name="weight"]').val(totalWeight)
    })

    // Show city and province shipping
    $('select[name="province_id"]').on('change', function() {
        let province = $(this).val()

        if(province) {
            $.ajax({
                url: `http://127.0.0.1:8000/shopping/city/${province}`,
                type: 'GET',
                dataType:'json',
                success:function(data){
                    $(`select[name="city_id"]`).empty();

                    $(`select[name="city_id"]`).append(
                        `<option selected disabled>Pilih kota tujuan . . .</option>`
                    )

                    $.each(data, function(key, value) {
                        $(`select[name="city_id"]`).append(
                            `<option value="${value.city_id}">${value.type} ${value.city_name}</option>`
                        )
                    })

                }
            })
        } else {
            $(`select[name="city_id"]`).append(
                `<option disabled>---</option>`
            )
        }
    })

    // Show shipping cost
    $(`select[name="order[courier]"]`).on('change', function() {
        let origin = $(`input[name="city_origin"]`).val();
        let destination = $(`select[name="city_id"]`).val();
        let courier = $(`select[name="order[courier]"]`).val();
        let weight = $(`input[name="weight"]`).val();

        if(courier){
            $.ajax({
                url: `http://127.0.0.1:8000/shopping/courier/origin=${origin}&destination=${destination}&weight=${weight}&courier=${courier}`,
                type: 'GET',
                dataType: 'json',
                success:function(data){
                    $(`select[name="transaction[courier_cost]"]`).empty()

                    $(`select[name="transaction[courier_cost]"]`).append(
                        `<option selected disabled>Pilih layanan ekspedisi . . .</option>`
                    )

                    $.each(data, function(key, value) {
                        $.each(value.costs, function(key1, value1){
                            $.each(value1.cost, function(key2, value2){
                                $(`select[name="transaction[courier_cost]"]`).append(
                                    `<option value="${value2.value}">${value1.service} - ${value1.description} - ${value2.value}</option>`
                                );
                            })
                        }) 
                    })
                },
            })
        } else {
            $(`select[name="transaction[courier_cost]"]`).append(
                `<option disabled>---</option>`
            )
        }
    })
})
</script>
@endpush