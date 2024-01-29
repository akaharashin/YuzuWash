@extends('layout.main')

@section('title', 'Login Page')
    
@section('body')
    <div class="row mt-5 pt-5">
        <div class="col-3 mx-auto mt-5 pt-5">
            <div class="card d-flex p-3 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <label class="form-label text-center pb-2"> Username
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </label>
                        <label class="form-label text-center pb-4"> Password
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </label>

                        <button type="submit" class="btn btn-warning">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection