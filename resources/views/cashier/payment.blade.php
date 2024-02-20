@extends('layout.main')

@section('title', 'Pembayaran')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm bg-blue-1">
                <h3>Form Transaksi</h3>
                <div class="card-body">
                    <form action="{{ route('payment', $order->id) }}" method="POST" class="d-flex flex-column"
                        id="transactionForm">
                        @csrf
                        <label class="form-label"> Nama Pelanggan
                            <input type="text" class="form-control" name="custName" required
                                placeholder="Masukan nama pelanggan" value="{{ $order->customer }}" readonly>
                        </label>
                        <label class="form-label"> Kontak/No.Telp
                            <input type="text" class="form-control" name="contact" required
                                placeholder="Masukan kontak pelanggan" value="{{ $order->contact }}" readonly>
                        </label>
                        <label class="form-label"> Paket Pilihan
                            <input type="text" class="form-control" name="package" readonly required
                                value="{{ $order->product->name }}">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" readonly required
                                value="{{ $order->product->price }}">
                        </label>
                        <label class="form-label"> Uang Pembeli
                            <input type="number" class="form-control" name="cash" required
                                placeholder="Masukan uang pembayaran" id="cashInput" min="0">
                        </label>
                        <span id="invalidCash" class="text-danger d-none">Uang yang dimasukan tidak cukup untuk membeli
                            paket tersebut.</span>

                        <button type="button" class="btn btn-success mt-4" onclick="validateTransaction()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateTransaction() {
            var price = parseFloat(document.getElementById('transactionForm').elements['price'].value);
            var cash = parseFloat(document.getElementById('cashInput').value);

            var invalidCash = document.getElementById('invalidCash');

            if (isNaN(cash) || cash < price) {
                invalidCash.classList.remove('d-none');
                return false; // Tidak memungkinkan form disubmit jika validasi gagal
            } else {
                invalidCash.classList.add('d-none');
                document.getElementById('transactionForm').submit();
            }
        }
    </script>
@endsection
