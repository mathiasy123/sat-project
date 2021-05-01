@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Tambah Testimoni</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.testimonies.store') }}" method="post" class="user">
                        @csrf
                        
                        <div class="form-group">
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control form-control-user @error('customer_name') is-invalid @enderror" id="customerName"
                                placeholder="Nama pelanggan  . . ." autocomplete="off">

                            @error('customer_name')<small id="customerName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <textarea name="testimony" class="form-control @error('testimony') is-invalid @enderror" id="customerTestimony" rows="10" placeholder="Testimoni pelanggan . . .">{{ old('testimony') }}</textarea>

                            @error('testimony')<small id="customerName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Tambah Testimoni
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

