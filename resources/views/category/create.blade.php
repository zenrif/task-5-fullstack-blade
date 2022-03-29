@extends('layouts.app')

@section('content')

<h2>Tambah Category</h2>

<div class="col-lg-8 mt-3">
    <form method="post" action="/category" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="form-group row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Nama Kategori</label>
            <div class="col-sm-8">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autofocus required value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-sm-10">
            <div class="justify-content-end mt-4" style="float:right;">
                <a class="btn btn-success" onClick="javascript:history.back()">Kembali</a>
                <button type="submit" class="btn btn-primary">Buat</button>
            </div>
        </div>
    </form>
</div>
@endsection