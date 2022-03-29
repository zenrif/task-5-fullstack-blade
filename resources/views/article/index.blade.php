@extends('layouts.app')

@section('content')

<h2>Data Article</h2>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-8 mt-4">
    <a href="/article/create" class="btn btn-primary mb-4">Buat Article</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Penulis</th>
                <th scope="col" style="text-align: center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->author->name }}</td>
                <td style="text-align: center">
                    <a href="/article/{{ $post->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/article/{{ $post->id }}/edit" class="badge bg-warning"><span
                            data-feather="edit"></span></a>
                    <form action="/article/{{ $post->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

@endsection