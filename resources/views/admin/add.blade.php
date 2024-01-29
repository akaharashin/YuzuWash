@extends('layout.main')

@section('title', 'Transaction')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm">
                <h3>Tambah Paket Baru</h3>
                <div class="card-body">
                    <form action="{{ route('add') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Nama Paket
                            <input type="text" class="form-control" name="name" required placeholder="Nama Paket">
                        </label>
                        <label class="form-label"> Harga Paket
                            <input type="text" class="form-control" name="price" required>
                        </label>
                        <label class="form-label"> Deskripsi Paket
                            <input type="text" class="form-control" name="desc" require>
                        </label>
                        <label class="form-label"> Layanan 1
                            <input type="text" class="form-control" name="serv1" required>
                        </label>
                        <label class="form-label"> Layanan 2
                            <input type="text" class="form-control" name="serv2" required>
                        </label>
                        <label class="form-label"> Layanan 3
                            <input type="text" class="form-control" name="serv3" required>
                        </label>
                        <label class="form-label"> Estimate
                            <input type="text" class="form-control" name="estimate" required>
                        </label>
                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection