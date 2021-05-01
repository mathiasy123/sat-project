<!-- Carousel section -->
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @forelse ($banners as $banner)
        <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}"></li>
        @empty
        <li data-target="#carouselExampleCaptions" data-slide-to="0"></li>
        @endforelse
    </ol>

    <div class="carousel-inner">

        @forelse ($banners as $banner)
        @if($loop->first)
        <div class="carousel-item active">
            <img src="{{ url('storage/' . $banner->gallery_path) }}" class="d-block w-100" alt="carousel-{{ $loop->iteration }}">
        </div>
        @else
        <div class="carousel-item">
            <img src="{{ url('storage/' . $banner->gallery_path) }}" class="d-block w-100" alt="carousel-{{ $loop->iteration }}">
        </div>
        @endif

        @empty
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/500" class="d-block w-100" alt="carousel-1">
        </div>
        @endforelse

    </div>

    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- End carousel section -->