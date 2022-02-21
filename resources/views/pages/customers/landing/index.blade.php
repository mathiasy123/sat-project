 @extends('layouts.customers.default')
 
 @section('customer-content')
 <!-- Kenapa kami section -->
 <section class="bg-light p-5" id="kenapa-kami-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 order-last order-lg-first">
                <div class="content-text mt-3 p-3 mt-lg-5 p-lg-5 text-center text-lg-left">
                    <h1>Kenapa Kami?</h1>

                    <p class="mt-3">
                        Toko Sembada Anugrah Teknik adalah sebuah situs toko online mudah dan terpercaya. Kami memiliki toko fisik yang Anda bisa Kunjungi. Disini kami menjual beragam flowmeter, watermeter, SHM,Sensus dan Itron
                    </p>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <img src="{{ asset('customer-assets/images/kenapa-kami.jpg') }}" class="img-fluid mt-5 rounded shadow"
                    alt="kenapa-kami-image">
            </div>
        </div>
    </div>
</section>
<!-- End kenapa kami section -->

<!-- Kategori kami section -->
<section class="p-5" id="kategori-section">
    <div class="container">
        <h1 class="text-center mb-5">Kategori</h1>

        <div class="row justify-content-center text-center">
            @forelse ($categories as $category)
            @if($category->products()->exists() && $category->products()->first()->firstGallery()->exists())
            <div class="col12 col-sm-6  col-lg-4 mb-5">
                <a href="/shopping">
                <div class="card shadow">
                    <img src="{{ url('storage/' . $category->products()->first()->firstGallery()->where('status', 1)->first()->gallery_path) }}" class="card-img-top" alt="{{ $category->name }}"
                        height="300">

                    <div class="card-body">
                        <p class="card-text text-uppercase text-center font-weight-bold">{{ $category->name }}</p>
                    </div>
                </div>
                </a>
            </div>
            @else
            <div class="col12 col-sm-6  col-lg-4 mb-5">
                <div class="card shadow">
                    <img src="https://via.placeholder.com/500" class="card-img-top" alt="{{ $category->name }}"
                        height="300">

                    <div class="card-body">
                        <p class="card-text text-uppercase text-center font-weight-bold">{{ $category->name }}</p>
                    </div>
                </div>
            </div>
            @endif

            @empty
            <div class="col-12 col-sm-6 col-lg-4 mb-5">
                <h3 class="mt-5">-- Belum ada kategori --</h3>
            </div>
            @endforelse
            
        </div>
    </div>
</section>
<!-- End kategori kami section -->

<!-- Pembayaran section -->
<section class="p-5 bg-light" id="pembayaran-section">
    <div class="container">
        <h1 class="text-center mb-5">Pembayaran</h1>

        <div class="row p-5">
            <div class="col-12 col-md-6 text-center">
                <img src="{{ asset('customer-assets/images/pembayaran/bca.png') }}" class="img-fluid" alt="bca-pembayaran">
            </div>

            <div class="col-12 col-md-6 text-center">
                <img src="{{ asset('customer-assets/images/pembayaran/bni.png') }}" class="img-fluid" alt="bni-pembayaran">
            </div>

            <div class="col-12 col-md-6 text-center">
                <img src="{{ asset('customer-assets/images/pembayaran/bri.png') }}" class="img-fluid" alt="bri-pembayaran">
            </div>

            <div class="col-12 col-md-6 text-center">
                <img src="{{ asset('customer-assets/images/pembayaran/mandiri.png') }}" class="img-fluid" alt="mandiri-pembayaran">
            </div>
        </div>
    </div>
</section>
<!-- End pembayaran section -->

<!-- Jasa pengiriman & metode pembayaran section -->
<section class="p-5" id="pengiriman-pembayaran-section">
    <div class="container">
        <h1 class="text-center">Jasa Pengiriman & Metode Pembayaran</h1>

        <div class="row p-5">
            <div class="col-12 col-md-4 text-center">
                <img src="{{ asset('customer-assets/images/pengiriman/jne.png') }}" class="img-fluid" alt="jne-pengiriman">
            </div>

            <div class="col-12 col-md-4 text-center">
                <img src="{{ asset('customer-assets/images/pengiriman/pos-indo.png') }}" class="img-fluid" alt="pos-indo-pengiriman">
            </div>

            <div class="col-12 col-md-4 text-center">
                <img src="{{ asset('customer-assets/images/pengiriman/tiki.png') }}" class="img-fluid" alt="tiki-pengiriman">
            </div>

            <div class="col-12 col-md-4 text-center mt-5">
                <img src="{{ asset('customer-assets/images/pembayaran/visa.png') }}" class="img-fluid" alt="visa-pembayaran">
            </div>

            <div class="col-12 col-md-4 text-center mt-5">
                <img src="{{ asset('customer-assets/images/pembayaran/master-card.png') }}" class="img-fluid" alt="master-card-pembayaran">
            </div>

            <div class="col-12 col-md-4 text-center mt-5">
                <img src="{{ asset('customer-assets/images/pembayaran/ae.png') }}" class="img-fluid" alt="ae-pembayaran">
            </div>
        </div>
    </div>
</section>
<!-- End jasa pengiriman & metode pembayaran section -->

<!-- Video section -->
<section class="p-5 bg-light" id="video-section">
    <div class="container">
        <div class="row p-5">
            <div class="col-12 text-center">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item shadow-lg"
                        src="https://www.youtube.com/embed/lYMHGQ1oggc?rel=0"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End video section -->    
@endsection