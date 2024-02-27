@extends('layout.main')

@section('title', 'Laporan')

@section('body')
    <style>
        span .inline-flex svg{
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

        span .relative {
            display: none
        }
    </style>
    <div class="row mt-5 pt-5 pb-5 mb-5">
        <div class="col-md-10 mx-auto">
            <h3 class="mb-4">Laporan Transaksi</h3>
            @if (Session::has('message'))
                <span class="alert-success alert mb-5">{{ Session::get('message') }}</span>
            @endif
            <div class="card p-3 mt-4" style="background-color: #C5E8EF" data-aos="fade-in" data-aos-duration="1000">
                <div class="card-body">
                    <!-- Formulir Pencarian -->
                    <form action="{{ route('transactions.search') }}" method="GET" class="mb-3 w-75 text-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari...">
                            <button type="submit" class="btn btn-warning">Cari</button>
                        </div>
                    </form>

                    <a href="{{ route('log') }}" class="btn btn-success mb-4">Log Aktifitas</a>
                    <a href="javascript:void(0);" onclick="printInvoice()" class="btn btn-secondary mb-4">
                        Print satu halaman
                    </a>
                    <p class="text-success">*Data diurutkan dari yang paling terbaru</p>
                    <!-- Tabel Transaksi -->
                    <table class="table table-striped d-flex">
                        <tr class="table-success">
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Kontak Pelanggan</th>
                            <th>Uang Dibayar</th>
                            <th>Kembalian</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                        </tr>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $transaction->order->customer }}</td>
                                <td>{{ $transaction->order->contact }}</td>
                                <td>Rp{{ number_format($transaction->cash, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($transaction->change, 0, ',', '.') }}</td>
                                <td>{{ $transaction->uniqcode }}</td>
                                <td>{{ $carbonDate($transaction->created_at) }}
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
    <script>
        function printInvoice(url) {
            document.querySelectorAll('.btn-warning').forEach(function(btn) {
                btn.style.display = 'none';
        });

            var printContent = document.querySelector('table').cloneNode(true);

            var printWindow = window.open('', '_blank');
            printWindow.document.open();

            printWindow.document.write(
                '<html><head><title>Invoice Cuci Mobil</title><style>@media print {table {width: 100%; font-family: sans-serif; font-size: 12pt; border: 1px solid black; padding: 15px } th{border-bottom: 1px solid black;} tr:nth-child(even){background-color: lightblue;}}</style></head><img src="{{ asset('images/yuzu-tr.png') }}" width="75"><h2 style="font-family: sans-serif; display: inline-block; padding-left: 1em;">PT YuzuWash Sukabumi</h2><body>'
            );
            printWindow.document.write(printContent.outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            printWindow.print();
            printWindow.onafterprint = function() {
                printWindow.close();

                document.querySelectorAll('.btn-warning').forEach(function(btn) {
                    btn.style.display = 'inline';
                });
            };
        }
    </script>
@endsection
