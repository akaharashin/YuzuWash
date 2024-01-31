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
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if (auth()->user()->id == 3)
                <a href="" onclick="clearLog()" class="btn btn-danger">Clear Log</a>
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
