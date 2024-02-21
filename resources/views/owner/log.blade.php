@extends('layout.main')

@section('title', 'Log Aktifitas Petugas')

@section('body')
    <div class="row mt-5 mb-1 h-100">
        <div class="col-10 mx-auto">
            <h2 class="mb-4">Log Aktifitas</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Oleh</th>
                        <th>Aktifitas</th>
                        <th>Tanggal</th>
                        <th>Pukul</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->user->name ? $log->user->name : 'Pengguna' }}</td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ $carbonDate($log->created_at) }}
                            <td>{{ $log->created_at->format('H:i') }} WIB</td>
                            </tr>
                    @empty
                        <tr>
                            <td >Tidak ada aktifitas baru baru ini . . .</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex gap-3 mt-4 mb-5 pb-5">
                <a href="{{ route('report') }}" class="btn btn-success mb-5">Kembali</a>
                <form action="{{ route('clearLog') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Clear Log</button>
                </form>
            </div>
        </div>
    </div>
@endsection
