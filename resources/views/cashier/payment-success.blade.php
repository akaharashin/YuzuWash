@extends('layout.main')

@section('title', 'Pembayaran Berhasil!')

@section('body')

    <div class="row mt-5 pt-5 vh-100" data-aos="fade-in" data-aos-duration="1000">
        <div class="col-10 mx-auto">
            <div class="card">
                <div class="card-body bg-blue-1">
                    <h3 class>Pembayaran berhasil</h3>
                    <a href="{{ route('paymentHistory') }}" class="btn btn-success mt-3">Riwayat Pembayaran</a>
                    <table class="table mt-5 table-striped">
                        <tr class="table-success">
                            <th>Nama Pelanggan</th>
                            <th>Kontak Pelanggan</th>
                            <th>Uang Dibayar</th>
                            <th>Uang Kembalian</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th></th> <!-- Kolom kosong untuk menyimpan tombol cetak -->
                        </tr>
                        <tr>
                            <td>{{ $transaction->order->customer }}</td>
                            <td>{{ $transaction->order->contact }}</td>
                            <td>Rp{{ number_format($transaction->cash, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($transaction->change, 0, ',', '.') }}</td>
                            <td>{{ $transaction->uniqcode }}</td>
                            <td>{{ $carbonDate($transaction->created_at) }}
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
            printWindow.document.write(
                '<html><head><title>Invoice Cuci Mobil</title><style>@media print {table {width: 100%; font-family: sans-serif; font-size: 12pt; border: 1px solid black; padding: 10px} th{border-bottom: 1px solid black} }</style></head><img src="{{ asset('images/yuzu-tr.png') }}" width="75"><h2 style="font-family: sans-serif; display: inline-block; padding-left: 1em;">PT YuzuWash Sukabumi</h2><p style="font-family: sans-serif"; padding-left: 10em;>Jl. Pelabuhan No. 99, Kecamatan Citamiang, Kota Sukabumi, 43115</p><p style="font-family: sans-serif;">No Telp. 026-333</p><body>'
            );
            printWindow.document.write(printContent.outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Mencetak halaman baru
            printWindow.print();
            printWindow.onafterprint = function() {
                printWindow.close();
                // Tampilkan kembali tombol cetak setelah mencetak selesai
                document.getElementById('printButton').style.display = 'inline';
            };
        }
    </script>

@endsection
