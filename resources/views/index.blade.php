@extends('layout.main')

@section('title', 'Beranda')

@section('body')
    <section>
        <div class="row p-0" data-aos="fade-in" data-aos-duration="700">
            <div class="col-md-8 p-0">
                <img src="images/banner.jpg" alt="" class="img-fluid rounded-start" style="max-width: 100%;">
            </div>
            <div class="col-md-4 p-0 bg-banner" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                <div class="texts text-light pb-3 mb-5">
                    <h2 class="pt-5 mt-4 px-4">Jangan Ragu, Buktikan Sendiri Kualitas YuzuWash Dengan Layanan Satu Kali Cuci
                    </h2>
                    <p class="px-4 mt-4 fs-5">&#10004; Pesan &nbsp;&#10004; Datang &nbsp; &#10004;Bersih</p>
                </div>
            </div>
        </div>
    </section>
    <h1 class="text-center mt-4" data-aos="fade-up" data-aos-duration="1000">Paket Satu Kali Cuci YuzuWash</h1>
    <p class="fs-5 text-center" data-aos="fade-in" data-aos-duration="3000">Bebas Pilih Jenis Layanan Sesuai Keinginan Anda, Urusan Cuci Mobil Biar Kami Yang Kerjakan
    </p>
    <section>
        <div class="row mx-2 mx-md-5 px-2 px-md-5 mt-4">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card p-3 mb-4 shadow-sm cardbg" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p>{{ $product->desc }}</p>

                            <ul class="list-group mt-4" data-aos="fade-in" data-aos-duration="1000">
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
                                <a href="{{ route('orderForm', $product->id) }}" class="btn mt-3 btn-warning">Pesan</a>
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
