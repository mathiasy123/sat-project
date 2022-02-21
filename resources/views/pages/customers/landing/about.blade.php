@extends('layouts.customers.default')
 
@section('customer-content')
<!-- Tentang section -->
<section class="p-5" id="tentang-section">
    <div class="container">
        <h1 class="text-center mt-3">Bagaimana kami berdiri?</h1>

        <div class="row p-5">

            @if($description)
            <div class="col-12 col-lg-6">
              <p>{{ $description->first_paragraph }}</p>
            </div>

            <div class="col-12 col-lg-6">
              <p>{{ $description->second_paragraph }}</p>
            </div>

            @else
            <div class="col-12">
              <h3 class="text-center">-- Belum Ada Konten --</h3>
            </div>
            @endif

        </div>
    </div>
</section>
<!-- End tentang section -->

<!-- Layanan section -->
{{-- <section class="bg-light p-5" id="layanan-section">
    <div class="container">
        <h1 class="text-center mt-3">Layanan Kami</h1>

        <div class="row p-5">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      Featured
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Special title treatment</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      Featured
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Special title treatment</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      Featured
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Special title treatment</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- End layanan section -->
@endsection