@extends('layouts.app')

@section('title', 'Profile User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="{{url('/dashboard')}}" class="btn btn-md btn-primary my-2">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Profile Admin
                </div>

                <div class="card-body">
                    <!-- Status Aksi -->
                    @if(Session::has('success'))
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success alert-dismissible text-center">
                                <span>{{ Session::get('success') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mb-3 row">
                        <label for="staticName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticName"
                                value="{{Auth::user()->name}}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                value="{{Auth::user()->email}}">
                        </div>
                    </div>

                    <!-- Form Ubah Password -->
                    <form action="{{url('/change-password', Auth::user()->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-4">
                                <input type="password" name="password" class="form-control" id="inputPassword">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-warning text-white">Ubah Password</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection