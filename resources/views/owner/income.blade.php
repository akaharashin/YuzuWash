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
            <div class="card w-50 h-75 p-3">
                <h5>Fitur Pencarian Sesuai Tanggal</h5>
                <div class="card-body">
                    <form method="GET" action="{{ route('income') }}">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Tanggal Awal:</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <button type="submit" class="btn btn-secondary mt-3">Filter</button>
                    </form>
                </div>
            </div>
            <table class="table w-75">
                <thead>
                    <th>Tanggal</th>
                    <th>Pemasukan</th>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('D - d  M - Y') }}</td>
                            <td>Rp{{ number_format($transaction->order->product->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"><strong>Total Keuntungan:</strong> <strong
                                style="padding-left: 15em;">Rp{{ number_format($totalIncome, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('report') }}" class="btn btn-success" style="margin-left: 8em">Kembali</a>

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
