@extends('layout.main')

@section('title', 'Total Pemasukan')

@section('body')
    <canvas id="salesChart" width="400" height="200"></canvas>
    {{-- <button onclick="printChart()" class="btn btn-secondary">Print Chart</button> --}}

    <div class="row mt-5 mb-5 pb-5">
        <div class="col-md-10 mx-auto d-flex">
            <div class="card w-50 d-inline-block p-3" style="background-color: #C5E8EF" data-aos="fade-in"
                data-aos-duration="1000">
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
                <p class="text-success mt-2">*Data di urutkan dari yang terlama</p>
                @if ($startDate && $endDate)
                    <p>Berikut data transaksi dari tanggal : <br>{{ $carbonDate($startDate) }} sampai-
                        <br>{{ $carbonDate($endDate) }} &#8594;
                    </p>
                @else
                    <p>Berikut adalah semua data transaksi yang telah dilakukan &#8594;</p>
                @endif
            </div>
            <table class="table w-75 table-striped" data-aos="fade-right">
                <thead>
                    <th>No.</th>
                    <th>Hari/Tanggal</th>
                    <th>Pemasukan</th>
                </thead>
                <tbody>
                    @foreach ($dataTransactions as $transaction)
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
        <div class="d-flex justify-content-center mt-5 pagination">{{ $dataTransactions->links() }}</div>
    </div>
    <a href="{{ route('report') }}" class="btn btn-success" style="margin-left: 8em">Kembali</a>
    <script>
        function printIncome(url) {
            document.querySelectorAll('.btn-warning').forEach(function(btn) {
                btn.style.display = 'none';
            });

            let printContent = document.querySelector('table').cloneNode(true);

            let printWindow = window.open('', '_blank');
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

        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Pemasukan',
                    data: {!! json_encode($incomeData) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 3
                }]
            },
        });

        function updateChart(labels, data) {
            salesChart.data.labels = labels;
            salesChart.data.datasets[0].data = data;
            salesChart.update();
        }

        // function printChart() {
        //     let canvas = document.getElementById('salesChart');
        //     let img = canvas.toDataURL('image/png');

        //     let printWindow = window.open('');
        //     printWindow.document.open();
        //     printWindow.document.write('<img src="' + img + '" />');
        //     printWindow.document.close();

        //     printWindow.print();

        //     printWindow.onafterprint = () => {
        //         printWindow.close();

        //     }
        // }
    </script>

@endsection
