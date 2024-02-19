@extends('layout.main')

@section('title', 'Log')

@section('body')
    <div class="row mt-5 mb-1 vh-100">
        <div class="col-8 mx-auto">
            <h2 class="mb-4">Log Aktifitas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Oleh</th>
                        <th>Aktifitas</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->user->name ? $log->user->name : 'Pengguna' }}</td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->locale('id')->isoFormat('dddd - DD MMMM YYYY') }}
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('report') }}" class="btn btn-success">Kembali</a>
            @if (auth()->user()->id == 3)
                <a href="" onclick="clearLog()" class="btn btn-danger ms-2">Clear Log</a>
            @endif
        </div>
    </div>

    <script>
        const table = document.querySelector('.table');
        function clearLog() {
            table.style.display='none';
            event.preventDefault();
        } 
    </script>
@endsection
