@extends('layout.main')

@section('title', 'Invoice')

@section('body')
    <style>
        span .inline-flex svg{
            display: none;
        }
    </style>
    <div class="row pt-5 pb-5 mb-5">
        <div class="col-9 mx-auto">
            <h2 class="mb-4">Daftar Pesanan</h2>
            @if (Session::has('message'))
                <span class="alert-success alert mb-5">{{ Session::get('message') }}</span>
            @endif
            <h6 class="pt-4">Berikut ini adalah pesanan-pesanan yang baru di pesan customer</h6>
            <p>Klik Konfirmasi order untuk melanjutkan ke pembayaran</p>
            <table class="table table-striped mt-3">
                <thead>
                    <tr class="table-success">
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak Pelanggan</th>
                        <th>Paket</th>
                        <th>Harga Paket</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $order->custName }}</td>
                            <td>{{ $order->contact }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>Rp{{ number_format($order->product->price, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('dddd - DD MMMM YYYY') }}
                                <td>
                                <a href="{{ route('paymentPage', $order->id) }}" class="btn btn-success shadow-sm">Konfirmasi
                                    Order</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada pesanan saat ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <span class="text-center pt-3">{{ $orders->links() }}</span>
        </div>
    </div>
@endsection
