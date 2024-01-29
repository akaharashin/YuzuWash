@extends('layout.main')

@section('title', 'Invoice')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-8 mx-auto">
            <h2 class="mb-5">Cashier Dashboard</h2>
            <h6>Berikut ini adalah pesanan-pesanan yang baru di pesan cutomer</h6>
            <p>Klik Konfirmasi order untuk melanjutkan ke pemabayaran</p>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>Kontak Pelanggan</th>
                        <th>Paket Pilihan</th>
                        <th>Harga Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->custName }}</td>
                            <td>{{ $order->contact }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>Rp{{ $order->product->price }}</td>
                            <td>
                                <a href="{{ route('paymentPage', $order->id) }}" class="btn btn-warning">Konfirmasi Order</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada pesanan saat ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
