@extends('layouts.app')

@section('content')
<h2>Data Category</h2>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-8 mt-4">
    <a href="/category/create" class="btn btn-primary mb-4">Tambah Category</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col" style="text-align: center">No</th>
                <th scope="col">Category</th>
                <th scope="col">Pembuat</th>
                <th scope="col" style="text-align: center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->maker->name }}</td>
                <td style="text-align: center">
                    <a href="/category/{{ $category->id }}/edit" class="badge bg-warning"><span
                            data-feather="edit"></span></a>
                    <form action="/category/{{ $category->id }}" method="post" class="d-inline">
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
        {{ $categories->links() }}
    </div>
</div>
@endsection