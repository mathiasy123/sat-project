@extends('layouts.customers.default')
 
@section('customer-content')
<!-- Tempat section -->
<section class="p-5" id="kontak-section">
    <div class="container">
        <h1 class="text-center mt-3">Kunjungi Kami</h1>

        <div class="row">
            <div class="col-12 text-center mt-5">
                <div id="map-container-google-1" class="z-depth-1-half map-container shadow" style="height: 500px">
                    <iframe class="img-fluid" src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Tempat section -->

<!-- Hubungi section -->
<section class="p-5 bg-light" id="hubungi-section">
    <div class="container">
        <h1 class="text-center mt-3">Hubungi Kami</h1>

        <div class="row mt-5">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Alamat Lengkap</a>
                
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Nomor Telepon</a>

                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Email</a>

                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Media Sosial</a>
                </div>
            </div>

            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, impedit in aspernatur excepturi cum possimus itaque minima neque recusandae modi!
                    </div>

                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae porro quod vel necessitatibus ratione suscipit dolorum accusantium eaque. Laboriosam, consequatur.
                    </div>

                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dignissimos modi in illum veniam recusandae quos neque exercitationem laboriosam vitae.
                    </div>

                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente repellat ex nobis excepturi temporibus, consequatur sunt placeat dolorum tempore aliquid.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hubungi section -->
@endsection