@extends('layouts.admins.default')

@section('admin-content')
<h1 class="h3 mb-2 text-gray-800">Tambah Deskripsi</h1>

<p class="mb-4">
   Mohon mengisi data dengan lengkap dan valid
</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form action="{{ route('admins.descriptions.store') }}" method="post" class="user">
                        @csrf

                        <div class="form-group">
                            <textarea name="first_paragraph" class="form-control @error('first_paragraph') is-invalid @enderror" id="firstParagraph" rows="10" placeholder="Teks paragraf pertama . . .">{{ old('first_paragraph') }}</textarea>

                            @error('first_paragraph')<small id="firstParagraph" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <textarea name="second_paragraph" class="form-control @error('second_paragraph') is-invalid @enderror" id="secondParagraph" rows="10" placeholder="Teks paragraf pertama . . .">{{ old('second_paragraph') }}</textarea>

                            @error('second_paragraph')<small id="secondParagraph" class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>


                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Tambah Deskripsi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
