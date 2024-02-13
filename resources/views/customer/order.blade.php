@extends('layout.main')

@section('title', 'Transaction')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm">
                <h3>Form Transaksi</h3>
                <div class="card-body">
                    <form action="{{ route('order', $product->id) }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Nama Pelanggan
                            <input type="text" class="form-control" name="custName" required
                                placeholder="Masukan nama pelanggan">
                        </label>
                        <label class="form-label"> Kontak/No.Telp
                            <input type="text" class="form-control" name="contact" required
                                placeholder="Masukan kontak pelanggan">
                        </label>
                        <label class="form-label"> Paket Pilihan
                            <input type="text" class="form-control" name="package" disabled required
                                value="{{ $product->name }}">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" disabled required
                                value="{{ $product->price }}">
                        </label>
                        {{-- <label class="form-label"> Cash
                            <input type="text" class="form-control" name="cash" required placeholder="Masukan uang pembayaran">
                        </label> --}}

                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif


                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
