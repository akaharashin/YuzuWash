@extends('layout.main')

@section('title', 'Invoice')

@section('body')
    <style>
        span .inline-flex {
            display: none;
        }

        nav .justify-between {
            display: flex;
            justify-content: center;
        }

        nav p {
            display: flex;
            justify-content: center;
            text-indent: 4px
        }
    </style>
    <div class="row mt-5 pt-5 pb-5 mb-5">
        <div class="col-10 mx-auto">
            <h3 class="">Laporan Transaksi</h3>
            <div class="card p-3">
                <div class="card-body">
                    <!-- Formulir Pencarian -->
                    <form action="{{ route('transactions.search') }}" method="GET" class="mb-3 w-75 text-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari...">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                    <a href="{{ route('log') }}" class="btn btn-success mb-4">Log Aktifitas</a>

                    <!-- Tabel Transaksi -->
                    <table class="table d-flex flex-column">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Kontak Pelanggan</th>
                            <th>Uang Dibayar</th>
                            <th>Kembalian</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Cetak Invoice</th>
                        </tr>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $transaction->order->custName }}</td>
                                <td>{{ $transaction->order->contact }}</td>
                                <td>{{ number_format($transaction->cash, 0, ',' , '.') }}</td>
                                <td>Rp{{ number_format($transaction->change, 0, ',' , '.') }}</td>
                                <td>{{ $transaction->uniqcode }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning">
                                        Print
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
