@extends('layout.main')

@section('title', 'Admin')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-10 mx-auto">
            <a href="{{ route('addPage') }}" class="btn btn-success mb-4">Tambah Paket</a>
            <a href="{{ route('manageCashier') }}" class="btn btn-success mb-4">Manage Kasir</a>
            <a href="{{ route('log') }}" class="btn btn-success mb-4">Log Aktifitas</a>
            <div class="card">
                <table class="table">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Harga Paket</th>
                        <th>Deskripsi Paket</th>
                        <th>Layanan - Layanan</th>
                        <th>Estimasi</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>Rp{{ $product->price }}</td>
                        <td>{{ $product->desc }}</td>
                        <td>{{ $product->services }}</td>
                        <td>{{ $product->estimate }} Jam</td>
                        <td class="d-flex p-5 gap-2">
                            <a href="{{ route('editPage', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('delete', $product->id) }}" method="POST">
                            @csrf
                            <button onclick="return confirm('Apakah anda yakin menghapus paket tersebut?')" type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection