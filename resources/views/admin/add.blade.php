@extends('layout.main')

@section('title', 'Admin')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm bg-blue-1">
                <h3>Tambah Paket Cuci Baru</h3>
                <div class="card-body" >
                    <form action="{{ route('add') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Nama Paket
                            <input type="text" class="form-control" name="name" required placeholder="Masukan Nama Paket">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="number" class="form-control" name="price" required  placeholder="Masukan Harga Paket" >
                        </label>
                        <label class="form-label"> Deskripsi Paket
                            <input type="text" class="form-control" name="desc" require  placeholder="Masukan Deskripsi Paket">
                        </label>
                        <label class="form-label"> Layanan - layanan
                            <input type="text" class="form-control" name="services" required  placeholder="Masukan Layanan  ( dipisah dengan koma ',' ) untuk setiap layanan">
                        </label>
                        <label class="form-label"> Estimate
                            <input type="number" class="form-control" name="estimate" required  placeholder="Estimasi Pencucian">
                        </label>
                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection