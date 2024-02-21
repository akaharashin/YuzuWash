@extends('layout.main')

@section('title', 'Formulir Pemesanan')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm bg-blue-1">
                <h3>Formulir Pemesanan</h3>
                <div class="card-body">
                    <form action="{{ route('order', $product->id) }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Nama Pelanggan
                            <input type="text" class="form-control" name="customer" required
                                placeholder="Masukan nama pelanggan">
                        </label>
                        <label class="form-label"> Kontak/No.Telp
                            <input type="text" class="form-control" name="contact" required
                                placeholder="Masukan kontak pelanggan">
                        </label>
                        <label class="form-label"> Plat Nomer
                            <input type="text" class="form-control" name="plat" required" placeholder="Masukan Plat Kendaraan" required>
                        </label>
                        <label class="form-label"> Paket Pilihan
                            <input type="text" class="form-control" name="package" disabled required
                                value="{{ $product->name }}">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" disabled required
                                value="{{ $product->price }}">
                        </label>

                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
