@extends('layout.main')

@section('title', 'Pesanan Berhasil!')
    
@section('body')
    <div class="row mt-5 pt-5 vh-100">
        <div class="col-8 mx-auto">
            <div class="card shadow-sm bg-blue-1">
                <div class="card-body">
                    <h3>Pesanan cuci mobil anda berhasil! , pesanan anda akan <br> segera diproses ...</h3>
                    <p>Nomer anda akan segera di hubungi oleh petugas...</p>
                    <p>Hubungi Nomer ini untuk info selanjutnya: <a href="#">026-321-1</a></p>
                    <a href="/" class="btn btn-warning mt-5">Kembali</a>
                </div>
            </div>  
        </div>
    </div>
@endsection