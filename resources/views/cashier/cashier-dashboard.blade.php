@extends('layout.main')

@section('title', 'Daftar Pesanan')

@section('body')
    <style>
        span .inline-flex svg {
            display: none;
        }

        span .inline-flex {
            text-decoration: none;
        }
    </style>
    <div class="row pt-5 pb-5 mb-5">
        <div class="col-11 mx-auto">
            <div class="card p-3 bg-blue-1">
                <div class="card-body">
                    <h2 class="mb-4">Daftar Pesanan</h2>
                    @if (Session::has('message'))
                        <span class="alert-success alert mb-5">{{ Session::get('message') }}</span>
                    @endif
                    <h6 class="pt-4">Berikut ini adalah pesanan-pesanan yang baru di pesan customer</h6>
                    <p>Klik Konfirmasi order untuk melanjutkan ke pembayaran</p>
                    <p class="text-success">*Daftar di urutkan dari yang terlebih dahulu memesan</p>
                    <table class="table table-striped mt-3 shadow">
                        <thead>
                            <tr class="table-success">
                                <th>No.</th>
                                <th>Nama Pelanggan</th>
                                <th>Kontak Pelanggan</th>
                                <th>Plat Kendaraan</th>
                                <th>Paket</th>
                                <th>Harga Paket</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->customer }}</td>
                                    <td>{{ $order->contact }}</td>
                                    <td>{{ $order->plat }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>Rp{{ number_format($order->product->price, 0, ',', '.') }}</td>
                                    <td>{{ $carbonDateTime($order->created_at) }}.WIB</td>
                                    <td>
                                        <a href="{{ route('paymentPage', $order->id) }}"
                                            class="btn btn-success shadow-sm">Konfirmasi
                                            Pesanan</a>
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
        </div>
    </div>
@endsection
