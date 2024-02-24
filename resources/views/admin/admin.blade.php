@extends('layout.main')

@section('title', 'Admin')

@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-md-10 mx-auto">
            <a href="{{ route('addPage') }}" class="btn btn-success mb-4">Tambah Paket Baru</a>
            <a href="{{ route('manageCashier') }}" class="btn btn-success mb-4">Kelola Kasir</a>
            {{-- <a href="{{ route('log') }}" class="btn btn-success mb-4">Log Aktifitas</a> --}}
            @if (Session::has('message'))
                <span class="alert-success alert mb-5 d-block w-50">{{ Session::get('message') }}</span>
            @endif
            <div class="card" data-aos="fade-in" data-aos-duration="1000">
                <table class="table table-striped table-info">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Layanan - Layanan</th>
                        <th>Estimasi</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>Rp{{ number_format($product->price, 0, ',' , '.') }}</td>
                            <td>{{ $product->desc }}</td>
                            <td>{{ $product->services }}</td>
                            <td>{{ $product->estimate }} Jam</td>
                            <td class="d-flex p-5 gap-2">
                                <a href="{{ route('editPage', $product->id) }}" class="btn btn-info">Edit</a>
                                <form action="{{ route('delete', $product->id) }}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Apakah anda yakin menghapus paket tersebut?')"
                                        type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
