<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ $pengaturan->site_name }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('events.index') }}" class="nav-link">Event</a></li>
                <li class="nav-item"><a href="{{ route('artis.index') }}" class="nav-link">Artist</a></li>
                <li class="nav-item"><a href="{{ route('posts.index') }}" class="nav-link">News</a></li>
                @guest
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('transaksi.index') }}">History Transaksi</a>
                            <a class="dropdown-item" href="{{ route('tiket.index') }}">Tiket</a>
                            <a class="dropdown-item" href="{{ route('pengembalian-dana.index') }}">Pengembalian Dana</a>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"
                                onclick="document.getElementById('logout').submit()">Logout</a>
                            <form action="{{ route('logout') }}" method="post" id="logout">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
