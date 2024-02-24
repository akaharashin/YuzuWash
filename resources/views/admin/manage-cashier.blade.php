@extends('layout.main')

@section('title', 'Admin')

@section('body')
    <div class="row mt-5 pt-5 vh-100">
        <div class="col-md-10 mx-auto">
            <a href="{{ route('addCashierPage') }}" class="btn btn-success mb-4">Tambah Kasir Baru</a>

            <a href="{{ route('admin') }}" class="btn btn-success mb-4">Kembali</a>
            @if (Session::has('message'))
                <span class="alert-success alert mb-5 d-block w-25">{{ Session::get('message') }}</span>
            @endif
            <div class="card" data-aos="fade-in" data-aos-duration="1000">
                <table class="table table-info table-striped">
                    <tr>
                        <th>Username</th>
                        <th>Nama Kasir</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($cashiers as $cashier)
                        <tr>
                            <td>{{ $cashier->username }}</td>
                            <td>{{ $cashier->name }}</td>
                            <td class="d-flex gap-3">
                                <a href="{{ route('editCashier', $cashier->id) }}" class="btn btn-info">Edit Kasir</a>
                                <form action="{{ route('deleteCashier', $cashier->id) }}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Apakah anda yakin akan menghapus kasir tersebut?')"
                                        type="submit" class="btn btn-danger">Hapus Kasir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        Swal.fire({
            title: 'Hello!',
            text: 'This is a SweetAlert dialog!',
            icon: 'success',
            confirmButtonText: 'Cool'
        });
    </script>

@endsection
