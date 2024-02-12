@extends('layout.main')

@section('title', 'Total Pemasukan')

@section('body')
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
                        <button type="submit" class="btn btn-secondary mt-3 d-flex">Filter</button>
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
                            <td>{{ $transaction->created_at }}</td>
                            <td>Rp{{ number_format($transaction->cash, 0, ',', '.') }}</td>
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

@endsection
