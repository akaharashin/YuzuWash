@extends('layout.main')

@section('title', 'Total Pemasukan')

@section('body')

    <style>
        /* .chart {
                                    width: 400px;
                                    height: 300px;
                                    border: 1px solid #ccc;
                                    position: relative;
                                }

                                .bar {
                                    position: absolute;
                                    bottom: 0;
                                    width: 20px;
                                    background-color: blue;
                                } */
    </style>
    <div class="row mt-5 mb-5 pb-5">
        <div class="col-10 mx-auto d-flex">
            <div class="card w-50 d-inline-block p-3" style="background-color: #C5E8EF">
                <h5>Filter Sesuai Tanggal</h5>
                <div class="card-body">
                    <form method="GET" action="{{ route('income') }}">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Tanggal Awal:</label>
                            <input type="date" class="form-control start_date" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <button type="submit" class="btn btn-secondary mt-3">Filter</button>
                        <a href="javascript:void(0);" onclick="printIncome()" class="btn btn-secondary mt-3">Print Hasil
                            Filter</a>
                    </form>
                </div>
                <p class="text-success mt-2">*Data di urutkan dari yang terbaru</p>
                @if ($startDate && $endDate) 
                    <p>Berikut data transaksi dari tanggal : <br>{{ $carbonDate($startDate) }} sampai-
                        <br>{{ $carbonDate($endDate) }} &#8594;</p>
                @endif
            </div>
            <table class="table w-75 table-striped">
                <thead>
                    <th>No.</th>
                    <th>Hari/Tanggal</th>
                    <th>Pemasukan</th>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->index + 1 }}.</td>
                            <td>{{ $carbonDate($transaction->created_at) }}
                            <td>Rp{{ number_format($transaction->order->product->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><strong style="padding-left: 1em">Total Keuntungan:</strong> <strong
                                style="padding-left: 17em;">Rp{{ number_format($totalIncome, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('report') }}" class="btn btn-success" style="margin-left: 8em">Kembali</a>

    <script>
        function printIncome(url) {
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

    {{-- <div class="chart" id="chart"></div>
    
    <script>
        // Data keuntungan per bulan dari controller
        const monthlyIncome = {!! json_encode($monthlyIncome) !!};
        // Tinggi maksimum grafik
        const maxHeight = 300;
        // Menghitung tinggi maksimum untuk skala yang konsisten
        const maxIncome = Math.max(...monthlyIncome);
        const barHeights = monthlyIncome.map(income => (income / maxIncome) * maxHeight);
      
        // Select chart container
        const chartContainer = document.getElementById('chart');
      
        // Draw bars
        barHeights.forEach((barHeight, index) => {
          const bar = document.createElement('div');
          bar.className = 'bar';
          bar.style.height = barHeight + 'px';
          bar.style.left = (index * 30 + 10) + 'px';
          chartContainer.appendChild(bar);
        });
      </script> --}}

@endsection
