@extends('layout.main')

@section('title', 'Riwayat Pembayaran')

@section('body')
    <style>
        span .inline-flex svg {
            display: none;
        }

        span .inline-flex{
            text-decoration: none;
        }

        .card{
            background-color: #C5E8EF;
        }
        
    </style>
    <div class="row mt-5 pb-5 mb-5">
        <div class="col-10 mx-auto">
            <div class="card p-3 bg-blue-1">
                <div class="card-body">
                    <h3 class="">Riwayat Pembayaran</h3>
                    <a href="javascript:void(0);" onclick="printInvoice()" class="btn btn-secondary mt-3">
                        Print satu halaman
                    </a>
                    <!-- Formulir Pencarian -->
                    <form action="{{ route('transactions.search.cashier') }}" method="GET" class="mt-3 mb-3 w-75 text-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari...">
                            <button type="submit" class="btn btn-warning">Cari</button>
                        </div>
                    </form>
                    <p class="text-success">*Data diurutkan dari yang paling terbaru</p>

                    <table class="table table-striped mt-5 d-flex flex-column">
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
                                <td>{{ number_format($transaction->cash, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($transaction->change, 0, ',', '.') }}</td>
                                <td>{{ $transaction->uniqcode }}</td>
                                <td>{{ $carbonDate($transaction->created_at) }}
                                </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada riwayat pesanan saat ini : </td>
                            </tr>
                        @endforelse
                    </table>
                    <span class="text-center">{{ $transactions->links() }}</span>
                    @if ($transactions->isNotEmpty())
                        <a href="{{ route('paymentSuccess', $transactions[0]->id) }}" class="btn btn-success">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

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
        printWindow.document.write(
            '<html><head><title>Invoice Cuci Mobil</title><style>@media print {table {width: 100%; font-family: sans-serif; font-size: 12pt; border: 1px solid black; padding: 15px } th{border-bottom: 1px solid black;} tr:nth-child(even){background-color: lightblue;}}</style></head><body>'
        );
        printWindow.document.write(printContent.outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Mencetak halaman baru
        printWindow.print();
        printWindow.onafterprint = function() {
            printWindow.close();

            // Tampilkan kembali tombol cetak setelah mencetak selesai
            document.querySelectorAll('.btn-warning').forEach(function(btn) {
                btn.style.display = 'inline';
            });
        };
    }
</script>
