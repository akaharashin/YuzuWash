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
            <h3 class="mb-4">Laporan Transaksi</h3>
            @if (Session::has('message'))
                <span class="alert-success alert mb-5">{{ Session::get('message') }}</span>
            @endif
            <div class="card p-3 mt-4">
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
                        </tr>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $transaction->order->custName }}</td>
                                <td>{{ $transaction->order->contact }}</td>
                                <td>{{ number_format($transaction->cash, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($transaction->change, 0, ',', '.') }}</td>
                                <td>{{ $transaction->uniqcode }}</td>
                                <td>{{ $transaction->created_at->format('d M - Y') }}</td>
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
            // Sembunyikan tombol cetak sebelum mencetak
            document.querySelectorAll('.btn-warning').forEach(function(btn) {
                btn.style.display = 'none';
            });
    
            // Membuat salinan elemen tabel yang ingin dicetak
            var printContent = document.querySelector('table').cloneNode(true);
    
            // Membuat halaman baru untuk mencetak
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
    
            // Menambahkan elemen tabel yang telah disalin ke   halaman baru
            printWindow.document.write('<html><head><title>Invoice Cuci Mobil</title><style>@media print {table {width: 100%; font-family: "Arial", sans-serif; font-size: 12pt;}}</style></head><body>');
            printWindow.document.write(printContent.outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
    
            // Mencetak halaman baru
            printWindow.print();
            printWindow.onafterprint = function () {
                printWindow.close();
                
                // Tampilkan kembali tombol cetak setelah mencetak selesai
                document.querySelectorAll('.btn-warning').forEach(function(btn) {
                    btn.style.display = 'inline';
                });
            };
        }
    </script>
@endsection
