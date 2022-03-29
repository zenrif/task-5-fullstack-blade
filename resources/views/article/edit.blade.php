@extends('layouts.app')

@section('content')

<h2>Edit Artikel</h2>

<div class="col-lg-8">
    <form method="post" action="/article/{{ $post->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-8">
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    autofocus required value="{{ old('title', $post->title) }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="category" class="col-sm-2 form-label">Category</label>
            <div class="col-sm-8">
                <select class="form-select" name="category_id">
                    @foreach($categories as $category)
                    @if(old('category_id', $post->category_id ) == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="image" class="col-sm-2 form-label">Post Image</label>
            <input type="hidden" name="oldImage" value="{{ $post->image }}">
            <div class="col-sm-8">
                @if($post->image)
                <img src="{{ asset('post-images/'. $post->image) }}" class="img-preview img-fluid mb-3 col-5 d-block">
                @else
                <img class="img-preview img-fluid mb-3 col-5">
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="content" class="col-sm-2 col-form-label @error('content') is-invalid @enderror">Content
                Artikel</label>
            <div class="col-sm-8">
                <textarea class="form-control" id="content" name="content"
                    value="{{ old('content') }}">{{ $post->content }}</textarea>
                @error('content')
                <div class=" invalid-feedback">
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

<script>
    CKEDITOR.replace(content);

    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection