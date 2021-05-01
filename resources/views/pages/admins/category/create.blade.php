@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Tambah Kategori</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.categories.store') }}" method="POST" class="user">
                        @csrf

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="categoryCode"
                                placeholder="Kode kategori digenerate otomatis  . . ." disabled>
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-user @error('name') is-invalid @enderror" id="categoryName"
                                placeholder="Nama kategori  . . ." autocomplete="off">

                            @error('name')<small id="categoryName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Tambah Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

