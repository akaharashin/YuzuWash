@extends('layout.main')

@section('title', 'Beranda')

@section('body')
    <section>
        <div class="row p-0">
            <div class="col-8 p-0">
                <img src="images/banner.jpg" alt="" class="rounded-start" width="100%">
            </div>
            <div class="col-4 p-0 bg-banner" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px; height: 100%;">
                <div class="texts text-light pb-3 mb-5">
                    <h2 class="pt-5 mt-4 px-4">Jangan Ragu, Buktikan Sendiri Kualitas YuzuWash Dengan Layanan Satu Kali Cuci
                    </h2>
                    <p class="px-5 mt-5 fs-5" style="padding-bottom: 42px;"> &#10004; Pesan &nbsp;&#10004; Datang &nbsp; &#10004;Bersih</p>
                </div>
            </div>
        </div>
    </section>
    <h1 class="text-center mt-4">Paket Satu Kali Cuci YuzuWash</h1>
    <p class="fs-5 text-center">Bebas Pilih Jenis Layanan Sesuai Keinginan Anda, Urusan Cuci Mobil Biar Kami Yang Kerjakan
    </p>
    <section>
        <div class="row mx-5 px-5 mt-4">
            @foreach ($products as $product)
                <div class="col-4">
                    <div class="card p-3 mb-4 shadow-sm cardbg">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p>{{ $product->desc }}</p>

                            <ul class="list-group mt-4">
                                @foreach (explode(',', $product->services) as $service)
                                    <li class="list-group-item bg-yellow-1">&#128505; {{ trim($service) }}</li>
                                @endforeach
                            </ul>
                            <label for="" class="d-block mt-4 opacity-75">Harga</label>
                            <span
                                class="card-text d-block fw-bold pb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="border p-1 rounded-pill w-50 text-center mb-2 fw-medium text-white"
                                style="font-size: 0.9em; background-color: #1B8597">&#x1F551; Estimasi
                                {{ $product->estimate }} jam</span>
                            @guest
                                <a href="{{ route('orderForm', $product->id) }}" class="btn mt-3 btn-warning
                                    ">Pesan</a>
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
