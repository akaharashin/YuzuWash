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
    <div class="row mt-5 pt-5">
        <div class="col-8 mx-auto">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="">History Pembayaran</h3>
                    <table class="table mt-5 d-flex flex-column p-5">
                        <tr>
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
                                <td>{{ $transaction->order->custName }}</td>
                                <td>{{ $transaction->order->contact }}</td>
                                <td>{{ $transaction->cash }}</td>
                                <td>Rp{{ $transaction->change }}</td>
                                <td>{{ $transaction->uniqcode }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>
                                    <a href="{{ route('paymentPage', $transaction->id) }}" class="btn btn-warning">
                                        Print</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada riwayat pesanan saat ini : </td>
                            </tr>
                        @endforelse
                        {{ $transactions->links() }}
                    </table>
                    @if ($transactions->isNotEmpty())
                        <a href="{{ route('paymentSuccess', $transaction->id) }}" class="btn btn-warning mt-5">Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
