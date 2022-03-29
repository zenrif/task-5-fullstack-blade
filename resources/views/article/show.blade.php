@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <a class="btn btn-success" onClick="javascript:history.back()">Kembali</a>
            <a href="/article/{{ $post->id }}/edit" class="btn btn-warning">Edit</a>
            <form action="/article/{{ $post->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger"
                    onclick="return confirm('Apakah anda yakin ingin menghapus artikel ini?')">Hapus</button>
            </form>
            <p class="mt-3">Penulis : {{ $post->author->name }}
                <br>
                Dibuat pada {{ date('d/m/Y', strtotime($post->created_at)) }}
                <br>
                Kategori : {{ $post->category->name }}
            </p>
            @if($post->image)
            <div style="overflow:hidden;">
                <img src="{{ asset('post-images/'. $post->image) }}" class="img-fluid mt-3">
            </div>
            @endif

            <article class="text-black my-3 fs-5">
                <p>{!! $post->content !!} </p>
            </article>
        </div>
    </div>
</div>
@endsection