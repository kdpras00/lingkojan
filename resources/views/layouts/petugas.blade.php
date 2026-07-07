<!DOCTYPE html>
<html style="background: #f8f9fa url('{{ asset('images/banner.png') }}') repeat fixed; background-size: auto;" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - LingKojan Petugas</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="preload" as="image" href="{{ asset('images/banner.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            
            background-image: url("{{ asset('images/banner.png') }}");
            background-size: auto;
            background-repeat: repeat;
            background-attachment: fixed;
            color: #333;
            margin: 0;
            min-height: 100vh;
        }

        /* Unified Navbar Styling */
        .navbar-main {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: transparent;
            z-index: 1000;
            padding: 20px 0;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-link { 
            color: #333; 
            font-weight: 500; 
            transition: all 0.3s; 
            white-space: nowrap; 
            padding: 8px 15px;
            border-radius: 12px;
        }
        
        .nav-link:hover { 
            color: #f07c1b; 
        }

        .nav-link.active {
            color: #f07c1b;
            font-weight: 600;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px;
            transition: all 0.3s;
        }

        .user-trigger:hover {
            opacity: 0.8;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: -70px;
            top: 100%;
            background: white;
            min-width: 200px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
            padding: 10px;
            z-index: 1001;
            margin-top: 10px;
        }

        /* Bridge to prevent dropdown from closing when hovering gap */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -15px;
            left: 0;
            right: 0;
            height: 15px;
            background: transparent;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background: #fff8e1;
            color: #f07c1b;
        }

        /* Main Content Styling */
        .main-content {
            padding: 120px 30px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.1);
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.13);
            transform: translateY(-2px);
        }
    
        }');
            background-repeat: repeat;
            background-size: auto;
            z-index: -1;
            transform: translateZ(0);
            will-change: transform;
        }
    
    
        @keyframes fadeInPage {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .main-content, .card, .navbar-main, .auth-container {
            animation: fadeInPage 0.4s ease-out forwards;
        }
    
    </style>
    @yield('styles')
</head>
<body style="margin: 0; min-height: 100vh; background: transparent;">
    <nav class="navbar-main relative">
        <div class="navbar-container">
            <!-- Logo (Left) -->
            <div class="flex items-center">
                <img src="{{ asset('images/iconkojan.png') }}" alt="LingKojan" class="h-9 select-none">
            </div>

            <!-- Menu Links & User Profile (Far Right) - Desktop -->
            <div class="hidden md:flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('petugas.dashboard') }}" class="nav-link {{ Request::routeIs('petugas.dashboard') ? 'active' : '' }}">Dashboard</a>
                </div>
                
                <div class="w-px h-6 bg-gray-200"></div>

                <!-- User Profile (Far Right) -->
                <div class="user-dropdown">
                    <div class="user-trigger">
                        <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                        <span class="text-base font-semibold text-gray-700">{{ Auth::user()->name ?? 'Petugas' }}</span>
                    </div>
                    <div class="dropdown-menu">
                        <form action="{{ route('logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit" class="dropdown-item text-red-500 hover:bg-red-50 w-full text-left">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Toggle Button -->
            <div class="flex md:hidden">
                <button id="mobile-menu-btn" type="button" class="text-gray-800 hover:text-[#f07c1b] focus:outline-none focus:text-[#f07c1b] transition duration-200 p-2 rounded-lg hover:bg-gray-100/50" aria-label="Toggle menu" aria-expanded="false">
                    <!-- Hamburger Icon (3 lines) -->
                    <svg id="hamburger-icon" class="h-6 w-6 block transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Close Icon (X) -->
                    <svg id="close-icon" class="h-6 w-6 hidden transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 w-full bg-white shadow-lg border-b border-gray-200 z-50 transition-all duration-300 ease-out transform -translate-y-2 opacity-0">
            <div class="px-6 py-5 space-y-3 flex flex-col">
                <a href="{{ route('petugas.dashboard') }}" class="w-full py-2.5 px-4 rounded-xl nav-link {{ Request::routeIs('petugas.dashboard') ? 'active bg-orange-50/50' : 'text-gray-700' }} hover:bg-orange-50 hover:text-[#f07c1b] transition-all duration-200">Dashboard</a>
                
                <div class="h-px bg-gray-100 my-2"></div>
                
                <div class="px-4 py-2 flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                    <span class="text-base font-semibold text-gray-700">{{ Auth::user()->name ?? 'Petugas' }}</span>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="btn-orange w-full text-center py-2.5 rounded-xl justify-center flex items-center">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            if (menuBtn && mobileMenu && hamburgerIcon && closeIcon) {
                const mainNav = menuBtn.closest('nav');
                if (mainNav) {
                    mainNav.style.transition = 'background-color 0.3s, box-shadow 0.3s';
                }

                menuBtn.addEventListener('click', function () {
                    const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
                    
                    if (isExpanded) {
                        menuBtn.setAttribute('aria-expanded', 'false');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                        
                        mobileMenu.classList.remove('-translate-y-0', 'opacity-100');
                        mobileMenu.classList.add('-translate-y-2', 'opacity-0');
                        if (mainNav) {
                            mainNav.style.backgroundColor = '';
                            mainNav.style.boxShadow = '';
                        }
                        setTimeout(() => {
                            if (menuBtn.getAttribute('aria-expanded') === 'false') {
                                mobileMenu.classList.add('hidden');
                            }
                        }, 300);
                    } else {
                        menuBtn.setAttribute('aria-expanded', 'true');
                        hamburgerIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                        
                        mobileMenu.classList.remove('hidden');
                        void mobileMenu.offsetHeight;
                        
                        mobileMenu.classList.remove('-translate-y-2', 'opacity-0');
                        mobileMenu.classList.add('-translate-y-0', 'opacity-100');
                        if (mainNav) {
                            mainNav.style.backgroundColor = 'white';
                            mainNav.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
                        }
                    }
                });

                document.addEventListener('click', function (event) {
                    if (!menuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                        if (menuBtn.getAttribute('aria-expanded') === 'true') {
                            menuBtn.click();
                        }
                    }
                });
            }
        });
    </script>

    <main class="main-content">
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl font-bold text-black">@yield('page_title', 'Dashboard Petugas')</h2>
            <p class="text-gray-500 font-medium">Layanan pengaduan masyarakat LingKojan</p>
        </div>

        <div class="content-body">
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#f07c1b',
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#f07c1b'
                    });
                </script>
            @endif

            @yield('content')
        </div>
    </main>

    @stack('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[name="nik"]').forEach(function(el) {
            el.setAttribute('maxlength', '16'); el.setAttribute('inputmode', 'numeric');
            el.addEventListener('input', function() { this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16); });
            el.addEventListener('paste', function(e) { e.preventDefault(); var p=(e.clipboardData||window.clipboardData).getData('text'); this.value=(this.value+p).replace(/[^0-9]/g,'').slice(0,16); });
        });
        document.querySelectorAll('input[name="phone"]').forEach(function(el) {
            el.setAttribute('maxlength', '15'); el.setAttribute('inputmode', 'numeric');
            el.addEventListener('input', function() { this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15); });
            el.addEventListener('paste', function(e) { e.preventDefault(); var p=(e.clipboardData||window.clipboardData).getData('text'); this.value=(this.value+p).replace(/[^0-9]/g,'').slice(0,15); });
        });
        document.querySelectorAll('input[name="username"]').forEach(function(el) {
            el.setAttribute('maxlength', '50');
            el.addEventListener('input', function() { this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').slice(0, 50); });
            el.addEventListener('paste', function(e) { e.preventDefault(); var p=(e.clipboardData||window.clipboardData).getData('text'); this.value=(this.value+p).replace(/[^a-zA-Z0-9]/g,'').slice(0,50); });
        });
    });
    </script>
</body>
</html>
