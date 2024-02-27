<nav class="navbar navbar-expand-lg px-5 shadow bg-nav">
   <a href="/" class="navbar-brand ps-4"> <img src="{{ asset('images/yuzu-navy.png') }}" style="width: 3.5em" alt=""></a>
    {{-- <a href="/" class="navbar-brand fw-bold text-white">YuzuWash</a> --}}
    <div class="container-fluid d-flex justify-content-end">
        <ul class="navbar-nav">
            @guest
                <li class="nav-item"><a href="{{ route('loginPage') }}" class="btn btn-warning">Masuk</a></li>
            @endguest

            @auth
                @if (auth()->user()->role == 'cashier')
                    <li class="nav-item"><a href="{{ route('cashierDashboard') }}" class="nav-link text-white">Daftar Pesanan</a></li>
                    <li class="nav-item" style="margin-right: 4em;"><a href="{{ route('paymentHistory') }}"
                            class="nav-link text-white">Riwayat Pembayaran</a>
                    </li>
                @endif
                @if (auth()->user()->role == 'owner')
                    <li class="nav-item"><a href="{{ route('report') }}" class="nav-link text-white">Laporan</a></li>
                    <li class="nav-item" style="margin-right: 4em;"><a href="{{ route('income') }}"
                            class="nav-link text-white">Penyaringan Keuntungan</a></li>
                @endif
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item" style="margin-right: 4em;"><a href="{{ route('admin') }}"
                            class="nav-link text-white">Dashboard</a></li>
                @endif

                <li class="nav-item"><a href="{{ route('logout') }}" class="btn btn-warning">Keluar</a></li>
            @endauth
        </ul>
    </div>
</nav>
