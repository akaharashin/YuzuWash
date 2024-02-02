@extends('layout.main')

@section('title', 'Transaction')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-6 mx-auto">
            <div class="card p-4 shadow-sm">
                <h3>Tambah Kasir Baru</h3>
                <div class="card-body">
                    <form action="{{ route('addCashier') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Username Kasir
                            <input type="text" class="form-control" name="username" required placeholder="Username Kasir">
                        </label>
                        <label class="form-label"> Password
                            <input type="password" class="form-control" name="password" required placeholder="Password Kasir">
                        </label>
                        <label class="form-label"> Nama Kasir
                            <input type="text" class="form-control" name="name" required placeholder="Nama Kasir">
                        </label>
                        {{-- <label class="form-label"> Role
                            <input type="text" class="form-control" name="role" required value="cashier" disabled>
                        </label> --}}
                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection