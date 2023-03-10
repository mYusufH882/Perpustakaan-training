@extends('layouts.app')

@section('title', 'Login')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    <div class="card-body">
                        @if (Session::get('success'))
                        <div class="alert alert-success">
                            <span class="text-success text-center">
                                {{Session::get('success')}}
                            </span>
                        </div>
                        @endif
                        <form action="{{url('/authenticate')}}" method="POST">
                            @csrf

                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" id="inputEmail" type="email"
                                    placeholder="name@example.com" value="{{old('email')}}" />
                                <label for="inputEmail">Email</label>
                                @error('email')
                                <div class="alert alert-danger">
                                    <span class="text-danger text-center">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="password" id="inputPassword" type="password"
                                    placeholder="Password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            {{-- <div class="form-check mb-3">
                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                            </div> --}}
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                {{-- <a class="small" href="password.html">Forgot Password?</a>
                                <a class="btn btn-primary" href="index.html">Login</a> --}}
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="/register">Belum punya akun? Daftar Sekarang!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection