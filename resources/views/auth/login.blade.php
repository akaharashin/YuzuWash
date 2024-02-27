@extends('layout.main')

@section('title', 'Halaman Login')

@section('body')
    <div class="row mt-3 pt-5 vh-100">
        <div class="col-md-6 mx-auto mt-4 pt-5">
            @if (Session::has('logout'))
                <span class="alert alert-success mb-4 d-block">{{ Session::get('logout') }}</span>
            @endif
            <div class="card d-flex p-0 shadow-sm" data-aos="fade-down" data-aos-duration="500">
                <div class="card-body p-0 d-flex bg-blue-1">
                    <div class="col-5">
                        <img src="{{ asset('images/kuruma.jpg') }}" alt="" class="card-img-top">
                    </div>
                    <div class="col-7 p-5">
                        <form action="{{ route('login') }}" method="POST" class="d-flex flex-column">
                            @csrf
                            <label class="form-label text-center pb-3"> Nama Pengguna
                                <input type="text" name="username" class="form-control mt-2" placeholder="Masukan nama pengguna"
                                    required autocomplete="none" >
                            </label>
                            <label class="form-label text-center"> Kata Sandi
                                <input type="password" name="password" class="form-control mt-2" placeholder="Masukan kata sandi"
                                    required autocomplete="none" >
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
    </div>
@endsection
