@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<div class="container-fluid">

    @if(auth()->user()->hasRole('operator'))
    <div class="row">
        <div class="col">
            <a href="{{url('/books/create')}}" class="btn btn-md btn-primary my-2">Tambah Data Baru</a>
        </div>
    </div>
    @endif

    @if(Session::has('success'))
    <div class="row">
        <div class="col">
            <div class="alert alert-success alert-dismissible text-center">
                <span>{{ Session::get('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="card p-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Buku
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Author</th>
                            <th>Dibuat Oleh</th>
                            <th>Cover</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->description}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->user->name}}</td>
                            <td><img src="storage/{{$book->cover}}" width="100" /></td>
                            <td>
                                <a href="{{url('/books/download', $book->id)}}"
                                    class="btn btn-info btn-sm text-white"><i class="fas fa-download"></i>
                                    Download PDF</a>
                                <br>
                                @if (auth()->user()->hasRole('operator'))
                                <a href="{{url('/books/edit')}}/{{$book->id}}"
                                    class="btn btn-warning btn-sm text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{url('/books/delete', $book->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                        Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection