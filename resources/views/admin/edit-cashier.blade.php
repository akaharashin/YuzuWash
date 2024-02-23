@extends('layout.main')

@section('title', 'Admin')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-md-6 mx-auto">
            <div class="card p-4 shadow-sm bg-blue-1">
                <h3>Edit Kasir</h3>
                <div class="card-body">
                    <form action="{{ route('updateCashier', $cashier->id) }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label"> Username Kasir
                            <input type="text" class="form-control" name="username" required placeholder="Nama Kasir" value="{{ $cashier->username }}">
                        </label>
                        <label class="form-label"> Password
                            <input type="password" class="form-control" name="password" required value="{{ $cashier->password }}">
                        </label>
                        <label class="form-label"> Nama Kasir
                            <input type="text" class="form-control" name="name" required placeholder="Nama Kasir" value="{{ $cashier->name }}">
                        </label>
                        <button type="submit" class="btn btn-warning mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection