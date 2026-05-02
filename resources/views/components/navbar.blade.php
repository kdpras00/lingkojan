<style>
    .nav-link { color: #333; font-weight: 500; transition: color 0.3s; white-space: nowrap; }
    .nav-link:hover { color: #f07c1b; }
    .text-orange-main { color: #f07c1b; }
    .btn-orange {
        background-color: #f07c1b;
        color: white;
        padding: 10px 25px;
        border-radius: 20px;
        font-weight: 600;
        transition: opacity 0.3s, transform 0.3s;
        display: inline-block;
        white-space: nowrap;
    }
    .btn-orange:hover { opacity: 0.9; transform: translateY(-2px); }
</style>

<nav id="main-nav" class="bg-transparent py-6 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('images/iconkojan.png') }}" alt="LingKojan" class="h-10 select-none">
        </div>
        <div class="hidden md:flex items-center space-x-10">
            <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'text-orange-main font-bold' : '' }}">Beranda</a>
            <a href="{{ route('tentang') }}" class="nav-link {{ Request::routeIs('tentang') ? 'text-orange-main font-bold' : '' }}">Tentang LingKojan</a>
            @auth
                @if(Auth::user()->hasRole('warga'))
                    <a href="{{ route('warga.dashboard') }}" class="nav-link">Ke Dashboard</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-orange">Keluar</button>
                </form>
            @else
                @if(!Request::routeIs('login') && !Request::routeIs('register'))
                    <a href="{{ route('login') }}" class="btn-orange">Masuk</a>
                @endif
            @endauth
        </div>
    </div>
</nav>
