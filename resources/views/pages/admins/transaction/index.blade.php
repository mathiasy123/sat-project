@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>

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
                        <th>Kode Transaksi</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Total</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->code }}</td>
                        <td>{{ $transaction->order->code }}</td>
                        <td>{{ $transaction->order->buyer->name }}</td>
                        <td>{{ 'Rp. ' . number_format($transaction->total, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($transaction->status == 'GAGAL')
                            <span class="badge badge-danger p-2 w-100">Gagal
                            @elseif($transaction->status == 'SUKSES')
                            <span class="badge badge-success p-2 w-100">Sukses
                            @elseif($transaction->status == 'PENDING')
                            <span class="badge badge-warning p-2 w-100">Pending
                            @elseif($transaction->status == 'SUDAH BAYAR')
                            <span class="badge badge-info p-2 w-100">Sudah Bayar
                            @else
                            <span class="badge badge-warning p-2 w-100">Proses Kirim
                            @endif
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admins.transactions.show', ['transaction' => $transaction->id]) }}" class="btn btn-primary">
                                <span class="icon text-white-50">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </a>
                            
                            <form action="{{ route('admins.transactions.destroy', ['transaction' => $transaction->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?')">
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

