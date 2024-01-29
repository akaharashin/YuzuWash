@extends('layout.main')

@section('title', 'Invoice')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3>Transaksi cuci mobil berhasil</h3>
                    <a href="{{ route('paymentHistory') }}" class="btn btn-warning">Riwayat Pembayaran</a>
                    <table class="table mt-5">
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Kontak Pelanggan</th>
                            <th>Uang Dibayar</th>
                            <th>Kembalian</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Cetak Invoice</th>
                        </tr>
                        <tr>
                            <td>{{ $transaction->order->custName }}</td>
                            <td>{{ $transaction->order->contact }}</td>
                            <td>{{ $transaction->cash }}</td>
                            <td>Rp{{ $transaction->change }}</td>
                            <td>{{ $transaction->uniqcode }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>
                                <a href="#" class="btn btn-warning" id="printInvoiceBtn">
                                    Print
                                </a>
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('cashierDashboard') }}" class="btn btn-warning mt-5">Back</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('printInvoiceBtn').addEventListener('click', function() {
            // Sembunyikan tombol dan tautan lainnya sebelum mencetak
            var buttonsToHide = document.querySelectorAll('.btn');
            buttonsToHide.forEach(function(button) {
                button.style.display = 'none';
            });

            let table = document.querySelector('.table');

            // Panggil fungsi print
            window.print();

            // Tampilkan kembali tombol dan tautan setelah pencetakan selesai
            buttonsToHide.forEach(function(button) {
                button.style.display = 'inline';
            });
        });
    </script>
@endsection
