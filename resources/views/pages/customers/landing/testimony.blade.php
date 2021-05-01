@extends('layouts.customers.default')
 
@section('customer-content')
<!-- Testimoni section -->
<section class="p-5" id="testimoni-section">
    <div class="container">
        <h1 class="text-center mt-3">Apa kata mereka?</h1>

        <div class="row">

            @forelse ($testimonies as $testimony)
            <div class="col-12">
                <div class="content-text mt-3 p-3 text-center text-lg-left">
                    <div class="card shadow p-3 {{ ($loop->iteration % 2 == 0) ? 'text-right' : 'text-left' }}">
                        <div class="card-body">
                            <h1>{{ $testimony->customer_name }}</h1>

                            <blockquote class="blockquote">
                                <p class="mb-0">{{ $testimony->testimony }}</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="content-text mt-3 p-3 text-center text-lg-left">
                    <h3 class="text-center mt-5">-- Belum ada testimoni --</h3>
                </div>
            </div>
            @endforelse
            
        </div>
    </div>
</section>
<!-- End testimoni section -->
@endsection