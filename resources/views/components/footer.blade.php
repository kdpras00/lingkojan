<footer class="bg-white pt-20 pb-10 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 text-left">
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-1">
                <img src="{{ asset('storage/images/iconkojan.png') }}" alt="LingKojan" class="h-10 mb-6">
                <p class="text-gray-500 text-sm leading-relaxed">
                    Platform pengaduan masyarakat untuk lingkungan yang lebih bersih, aman, dan nyaman bagi semua warga.
                </p>
            </div>
            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-black mb-6">Tautan Cepat</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-orange-main transition-colors">Beranda</a></li>
                    <li><a href="{{ route('tentang') }}" class="text-gray-500 hover:text-orange-main transition-colors">Tentang LingKojan</a></li>
                    <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-orange-main transition-colors">Sampaikan Pengaduan</a></li>
                </ul>
            </div>
            <!-- Contact -->
            <div>
                <h4 class="font-bold text-black mb-6">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-orange-main shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Jl. Sitpon, RT. 007/RW. 008, Kampung Kojan, Kalideres, Jakarta Barat.
                    </li>
                </ul>
            </div>
            <!-- Social -->
            <div>
                <h4 class="font-bold text-black mb-6">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-orange-main hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <!-- Bottom Footer -->
        <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest">
            <p>&copy; 2024 LingKojan Team. All Rights Reserved.</p>
        </div>
    </div>
</footer>
