@extends('layouts.app')

@section('content')

<h2>Tambah Category</h2>

<div class="col-lg-8 mt-3">
    <form method="post" action="/category/{{ $category->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autofocus required value="{{ old('name', $category->name) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="justify-content-end mt-4" style="float:right;">
            <a class="btn btn-success" onClick="javascript:history.back()">Kembali</a>
            <button type="submit" class="btn btn-primary">Buat</button>
        </div>
    </form>
</div>
@endsection