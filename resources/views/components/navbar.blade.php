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

<nav id="main-nav" class="bg-transparent py-6 z-50 relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="{{ asset('images/iconkojan.png') }}" alt="LingKojan" class="h-10 select-none">
        </div>
        
        <!-- Desktop Links -->
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

        <!-- Mobile Toggle Button -->
        <div class="flex md:hidden">
            <button id="mobile-menu-btn" type="button" class="text-gray-800 hover:text-[#f07c1b] focus:outline-none focus:text-[#f07c1b] transition duration-200 p-2 rounded-lg hover:bg-gray-100/50" aria-label="Toggle menu" aria-expanded="false">
                <!-- Hamburger Icon (3 lines) -->
                <svg id="hamburger-icon" class="h-7 w-7 block transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <!-- Close Icon (X) -->
                <svg id="close-icon" class="h-7 w-7 hidden transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 w-full bg-white shadow-lg border-b border-gray-200 z-50 transition-all duration-300 ease-out transform -translate-y-2 opacity-0">
        <div class="px-6 py-5 space-y-3 flex flex-col">
            <a href="{{ route('home') }}" class="w-full py-2.5 px-4 rounded-xl nav-link {{ Request::routeIs('home') ? 'text-orange-main font-bold bg-orange-50/50' : 'text-gray-700' }} hover:bg-orange-50 hover:text-[#f07c1b] transition-all duration-200">Beranda</a>
            <a href="{{ route('tentang') }}" class="w-full py-2.5 px-4 rounded-xl nav-link {{ Request::routeIs('tentang') ? 'text-orange-main font-bold bg-orange-50/50' : 'text-gray-700' }} hover:bg-orange-50 hover:text-[#f07c1b] transition-all duration-200">Tentang LingKojan</a>
            @auth
                @if(Auth::user()->hasRole('warga'))
                    <a href="{{ route('warga.dashboard') }}" class="w-full py-2.5 px-4 rounded-xl nav-link text-gray-700 hover:bg-orange-50 hover:text-[#f07c1b] transition-all duration-200">Ke Dashboard</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="w-full pt-2">
                    @csrf
                    <button type="submit" class="btn-orange w-full text-center py-2.5 rounded-xl justify-center flex items-center">Keluar</button>
                </form>
            @else
                @if(!Request::routeIs('login') && !Request::routeIs('register'))
                    <a href="{{ route('login') }}" class="btn-orange w-full text-center py-2.5 rounded-xl justify-center flex items-center">Masuk</a>
                @endif
            @endauth
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
                    // Close the menu
                    menuBtn.setAttribute('aria-expanded', 'false');
                    
                    // Show hamburger, hide close icon
                    hamburgerIcon.classList.remove('hidden');
                    hamburgerIcon.classList.add('block');
                    closeIcon.classList.remove('block');
                    closeIcon.classList.add('hidden');
                    
                    // Animate closing
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
                    // Open the menu
                    menuBtn.setAttribute('aria-expanded', 'true');
                    
                    // Hide hamburger, show close icon
                    hamburgerIcon.classList.remove('block');
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    closeIcon.classList.add('block');
                    
                    // Show the menu container
                    mobileMenu.classList.remove('hidden');
                    
                    // Trigger reflow to activate transition
                    void mobileMenu.offsetHeight;
                    
                    // Animate opening
                    mobileMenu.classList.remove('-translate-y-2', 'opacity-0');
                    mobileMenu.classList.add('-translate-y-0', 'opacity-100');
                    if (mainNav) {
                        mainNav.style.backgroundColor = 'white';
                        mainNav.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
                    }
                }
            });

            // Close menu when clicking outside
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

