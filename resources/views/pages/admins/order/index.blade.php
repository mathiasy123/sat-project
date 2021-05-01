@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Pesanan</h1>

@if(session('alert-not-found'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Peringatan!</strong> {{ session('alert-not-found') }}
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

@if(session('alert-delete-restrict'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Peringatan!</strong> {{ session('alert-delete-restrict') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Pesanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Nama Produk</th>
                        <th>Nama Pemesan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->buyer->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('admins.orders.show', ['order' => $order->id]) }}" class="btn btn-primary">
                                <span class="icon text-white-50">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </a>

                            <form action="{{ route('admins.orders.destroy', ['order' => $order->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?')">
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

