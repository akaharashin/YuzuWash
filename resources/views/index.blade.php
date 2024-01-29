@extends('layout.main')

@section('title', 'Home')


@section('body')
    <h1 class="text-center mt-4">Paket Satu Kali Cuci YuzuWash</h1>
    <section>
        <div class="row mx-5 px-5 mt-4">
            @foreach ($products as $product)
                <div class="col-4">
                    <div class="card p-3">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p>{{ $product->desc }}</p>

                            <ul class="list-group mt-4">
                                <li class="list-group-item">{{ $product->serv1 }}</li>
                                <li class="list-group-item">{{ $product->serv2 }}</li>
                                <li class="list-group-item">{{ $product->serv3 }}</li>
                            </ul>
                            <label for="" class="d-block mt-4 opacity-75">Harga</label>
                            <span class="card-text d-block fw-bold pb-2">Rp{{ number_format($product->price, 0, ',' , '.') }}</span>
                            <span class="border p-1 rounded-pill bg-info w-50 text-center mb-2">Estimasi {{ $product->estimate }} jam</span>
                            <a href="{{ route('orderForm', $product->id) }}" class="btn btn-warning mt-3">Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
