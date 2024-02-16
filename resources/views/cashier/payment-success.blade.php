@extends('layout.main')

@section('title', 'Invoice')

@section('body')

    <div class="row mt-5 pt-5 vh-100">
        <div class="col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3>Transaksi cuci mobil berhasil</h3>
                    <a href="{{ route('paymentHistory') }}" class="btn btn-success mt-3">Riwayat Pembayaran</a>
                    <table class="table mt-5">
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Kontak Pelanggan</th>   
                            <th>Uang Dibayar</th>
                            <th>Uang Kembalian</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th></th> <!-- Kolom kosong untuk menyimpan tombol cetak -->
                        </tr>
                        <tr>

                            <td>{{ $transaction->order->custName }}</td>
                            <td>{{ $transaction->order->contact }}</td>
                            <td>Rp{{ number_format($transaction->cash, 0, ',' , '.') }}</td>
                            <td>Rp{{ number_format($transaction->change, 0, ',' , '.') }}</td>
                            <td>{{ $transaction->uniqcode }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>
                                <button class="btn btn-secondary" onclick="printInvoice()" id="printButton">
                                    Print
                                </button>
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('cashierDashboard') }}" class="btn btn-success mt-5">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printInvoice() {
            // Sembunyikan tombol cetak sebelum mencetak
            document.getElementById('printButton').style.display = 'none';

            // Membuat salinan elemen card yang ingin dicetak
            var printContent = document.querySelector('table').cloneNode(true);
            console.log(printContent)

            // Membuat halaman baru untuk mencetak
            var printWindow = window.open('', '_blank');
            printWindow.document.open();

            // Menambahkan elemen card yang telah disalin ke halaman baru
            printWindow.document.write('<html><head><title>Invoice Cuci Mobil</title><style>@media print {.card {width: 100%; font-family: sans; font-size: 12pt;}}</style></head><body>');
            printWindow.document.write(printContent.outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Mencetak halaman baru
            printWindow.print();
            printWindow.onafterprint = function () {
                printWindow.close();
                // Tampilkan kembali tombol cetak setelah mencetak selesai
                document.getElementById('printButton').style.display = 'inline';
            };
        }
    </script>

@endsection
