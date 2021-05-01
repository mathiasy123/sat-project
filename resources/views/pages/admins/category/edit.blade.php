@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Ubah Kategori</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.categories.update', ['category' => $category->id]) }}" method="post" class="user">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <input type="text" name="code" value="{{ old('code') ? old('code') : $category->code }}" class="form-control form-control-user" id="categoryCode"
                                placeholder="Kode kategori digenerate otomatis  . . ." disabled autocomplete="off">
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name') ? old('name') : $category->name }}" class="form-control form-control-user @error('name') is-invalid @enderror" id="categoryName"
                                placeholder="Nama kategori  . . ." autocomplete="off">
                            
                            @error('name')<small id="categoryName" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Ubah Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

