@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Banner</h1>

@if(session('alert-not-found'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Peringatan!</strong> {{ session('alert-not-found') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-store-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-store-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-update-status-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-update-status-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if(session('alert-delete-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-delete-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar Banner</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($banners as $banner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $banner->gallery_path) }}" alt="banner-{{ $loop->iteration }}" class="img-thumbnail" style="width: 200px; height: 180px">
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admins.banners.update-status', ['banner' => $banner->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('put')

                                <input type="hidden" name="status"  value="{{ $banner->status }}">
                                
                                @if($banner->status == 0) 
                                <button type="submit" class="btn btn-secondary" style="width: 30vh">
                                    Aktifkan Gambar
                                @else
                                <button type="submit" class="btn btn-success" style="width: 30vh">
                                    Non-Aktifkan Gambar
                                @endif
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admins.banners.destroy', ['banner' => $banner->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?')">
                                @csrf
                                @method('delete')
    
                                <button type="submit" class="btn btn-danger">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

