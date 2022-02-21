@extends('layouts.customers.default')
 
@section('customer-content')
<!-- Tempat section -->
<section class="p-5" id="kontak-section">
    <div class="container">
        <h1 class="text-center mt-3">Kunjungi Kami</h1>

        <div class="row">
            <div class="col-12 text-center mt-5">
                <div id="map-container-google-1" class="z-depth-1-half map-container shadow" style="height: 500px">
                    {{-- <iframe class="img-fluid" src="https://maps.google.com/maps?q=c3f7bCJshQmkLmFn7=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0;" allowfullscreen></iframe> --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126924.23687731203!2d106.85918300274017!3d-6.213193343940833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f50fa5ff8999%3A0xfe688bbd554362bb!2sMega%20Glodok%20Kemayoran!5e0!3m2!1sid!2sid!4v1621669520060!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                        Mall Mega Glodok Kemayoran Lantai GF Blok D10 No 6
                    </div>

                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        0216540986
                    </div>

                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        sembadaanugrahteknik@gmail.com
                    </div>

                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                      <br>  Whatsapp    : 0895347900080</br>
                        <br> Facebook    : </br>
                       <br> Instagram   : sembada_anugrahteknik</br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hubungi section -->
@endsection