@extends('layout.main')

@section('title', 'Admin')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm bg-blue-1">
                <h3>Update Paket Cuci Mobil</h3>
                <div class="card-body">
                    <form action="{{ route('update', $product->id) }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Nama Paket
                            <input type="text" class="form-control" name="name" required placeholder="Nama Paket" value="{{$product->name}}">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" required value="{{ $product->price }}">
                        </label>
                        <label class="form-label"> Deskripsi Paket
                            <input type="text" class="form-control" name="desc" require value="{{ $product->desc }}">
                        </label>
                        <label class="form-label"> Layanan - Layanan
                            <input type="text" class="form-control" name="services" required value="{{ $product->services }}">
                        </label>
                        <label class="form-label"> Estimate
                            <input type="text" class="form-control" name="estimate" required value="{{ $product->estimate }}">
                        </label>
                        <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection