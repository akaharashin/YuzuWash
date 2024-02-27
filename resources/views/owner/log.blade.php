@extends('layout.main')

@section('title', 'Log Aktifitas Petugas')

@section('body')
    <div class="row mt-5 mb-1 pb-4 h-100">
        <div class="col-md-10 mx-auto">
            <h2 class="mb-4">Log Aktifitas</h2>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('report') }}" class="btn btn-success mb-5">Kembali</a>
                <form action="{{ route('clearLog') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Clear Log</button>
                </form>
            </div>
            <table class="table table-striped" data-aos="fade-in" data-aos-duration="1000">
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
                            <td>Tidak ada aktifitas baru baru ini . . .</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center  mb-5 pb-5">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection
