<footer class="bg-white pt-20 pb-10 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16 text-left">
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
        </div>
        <!-- Bottom Footer -->
        <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest">
            <p>&copy; 2024 LingKojan Team. All Rights Reserved.</p>
        </div>
    </div>
</footer>
