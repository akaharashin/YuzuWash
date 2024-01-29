@extends('layout.main')

@section('title', 'Transaction')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm">
                <h3>Form Transaksi</h3>
                <div class="card-body">
                    <form action="{{ route('payment', $order->id) }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Nama Pelanggan
                            <input type="text" class="form-control" name="custName" required
                                placeholder="Masukan nama pelanggan" value="{{ $order->custName }}">
                        </label>
                        <label class="form-label"> Kontak/No.Telp
                            <input type="text" class="form-control" name="contact" required
                                placeholder="Masukan kontak pelanggan" value="{{ $order->contact }}">
                        </label>
                        <label class="form-label"> Paket Pilihan
                            <input type="text" class="form-control" name="package" disabled required
                                value="{{ $order->product->name }}">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" disabled required
                                value="{{ $order->product->price }}">
                        </label>
                        <label class="form-label"> Uang Pembeli
                            <input type="text" class="form-control" name="cash" required
                                placeholder="Masukan uang pembayaran">
                        </label>
                        @error('cash')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
