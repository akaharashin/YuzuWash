@extends('layout.main')

@section('title', 'Login Page')

@section('body')
    <div class="row mt-5 pt-5 vh-100">
        <div class="col-3 mx-auto mt-5 pt-5">
            @if (Session::has('logout'))
                <span class="alert alert-success mb-4 d-block">{{ Session::get('logout') }}</span>
            @endif
            <div class="card d-flex p-3 shadow-sm mb-2">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label text-center pb-2"> Nama Pengguna
                            <input type="text" name="username" class="form-control" placeholder="Nama Pengguna"
                                required>
                        </label>
                        <label class="form-label text-center"> Kata Sandi
                            <input type="password" name="password" class="form-control" placeholder="Kata Sandi"
                                required>
                        </label>
                        @if (Session::has('message'))
                            <span class="text-alert text-danger pb-4">{{ Session::get('message') }}</span>
                        @endif
                        <button type="submit" class="btn btn-warning mt-3">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
