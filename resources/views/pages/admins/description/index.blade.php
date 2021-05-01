@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Deskripsi</h1>

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

@if(session('alert-update-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-update-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-update-failed'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Gagal!</strong> {{ session('alert-update-failed') }}
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
                        <th>Teks Paragraf Pertama</th>
                        <th>Teks Paragraf Kedua</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($descriptions as $description)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $description->first_paragraph }}</td>
                        <td>{{ $description->second_paragraph }}</td>
                        <td class="text-center">
                            <form action="{{ route('admins.descriptions.update-status', ['description' => $description->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('put')

                                <input type="hidden" name="status"  value="{{ $description->status }}">
                                
                                @if($description->status == 0) 
                                <input type="hidden" name="active" value="1">
                                <button type="submit" class="btn btn-secondary" style="width: 30vh">
                                    Aktifkan Deskripsi
                                @else
                                <input type="hidden" name="active" value="0">
                                <button type="submit" class="btn btn-success" style="width: 30vh">
                                    Non-Aktifkan Deskripsi
                                @endif
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admins.descriptions.destroy', ['description' => $description->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?')">
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

