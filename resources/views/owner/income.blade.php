@extends('layout.main')

@section('title', 'Total Pemasukan')
    
@section('body')
    <div class="row mt-5">
        <div class="col-10 mx-auto">
            <table class="table">
                <thead>
                    <th>Tanggal</th>
                    <th>Pemasukan</th>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at }}</td>
                            <td>Rp{{ number_format($transaction->cash, 0, ',' , '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"><strong>Total:</strong> <strong style="padding-left: 38em;">Rp{{ number_format($totalIncome, 0, ',' , '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
