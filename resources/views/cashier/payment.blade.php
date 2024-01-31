@extends('layout.main')

@section('title', 'Transaction')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm">
                <h3>Form Transaksi</h3>
                <div class="card-body">
                    <form action="{{ route('payment', $order->id) }}" method="POST" class="d-flex flex-column"
                        id="transactionForm">
                        @csrf
                        <label class="form-label"> Nama Pelanggan
                            <input type="text" class="form-control" name="custName" required
                                placeholder="Masukan nama pelanggan" value="{{ $order->custName }}">
                        </label>
                        <label class="form-label"> Kontak/No.Telp
                            <input type="text" class="form-control" name="contact" required
                                placeholder="Masukan kontak pelanggan" value="{{ $order->contact }}">
                        </label>
                        <label class="form-label"> Paket Pilihan
                            <input type="text" class="form-control" name="package" disabled required
                                value="{{ $order->product->name }}">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" disabled required
                                value="{{ $order->product->price }}">
                        </label>
                        <label class="form-label"> Uang Pembeli
                            <input type="number" class="form-control" name="cash" required
                                placeholder="Masukan uang pembayaran" id="cashInput">
                        </label>
                        <span id="invalidCash" class="text-danger d-none">Uang yang dimasukan tidak cukup untuk membeli paket tersebut.</span>

                        <button type="button" class="btn btn-warning mt-4" onclick="validateTransaction()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateTransaction() {
            var price = document.getElementById('transactionForm').elements['price'].value;
            var cash = document.getElementById('cashInput').value;

            var invalidCash = document.getElementById('invalidCash');
            
            if (cash < price) {
                invalidCash.classList.remove('d-none');
            } else {
                invalidCash.classList.add('d-none');
                document.getElementById('transactionForm').submit();
            }
        }
    </script>
@endsection
