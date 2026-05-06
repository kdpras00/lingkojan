<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang LingKojan - LingKojan</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-image: url("{{ asset('images/banner.png') }}");
            background-size: auto;
            background-repeat: repeat;
            background-attachment: fixed;
            color: #333;
        }

        /* Visi Misi Section */
        .visi-misi-wrapper {
            background-color: #f07c1b;
            background-image: url("{{ asset('images/banner3.png') }}");
            background-size: auto;
            background-repeat: repeat;
            padding: 100px 0;
            position: relative;
            z-index: 1;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            padding: 50px;
            color: white;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-right: 20px;
        }

        /* Side by Side Grid */
        .grid-custom {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 40px;
            align-items: center; 
        }

        .contact-card {
            background: #f9fafb; 
            border-radius: 50px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.01);
            border: 1px solid rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(5px);
        }

        @media (max-width: 992px) {
            .grid-custom { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <!-- Intro Section (Polos Tanpa Kotak) -->
    <section class="py-24 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-[42px] font-extrabold text-black mb-8">Tentang LingKojan</h1>
            <div class="max-w-4xl mx-auto">
                <p class="text-black text-[15px] font-semibold leading-[1.8] text-center">
                    <span class="font-extrabold">LingKojan</span> merupakan platform pengaduan masyarakat berbasis web yang membantu warga menyampaikan laporan terkait permasalahan lingkungan secara mudah, cepat, dan transparan. Sistem ini hadir untuk menjembatani komunikasi antara masyarakat dan pihak terkait guna menciptakan lingkungan yang lebih tertata dan responsif.
                </p>
            </div>
        </div>
    </section>

    <!-- Visi & Misi Section (Exact Matching Design) -->
    <div class="visi-misi-wrapper">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid-custom">
                <!-- Visi -->
                <div class="glass-card">
                    <h2 class="text-[34px] font-bold mb-10">Visi LingKojan</h2>
                    <p class="text-[14px] leading-[2] font-medium opacity-100">
                        Mewujudkan layanan pengaduan masyarakat yang transparan, responsif, dan berbasis teknologi untuk mendukung terciptanya lingkungan yang tertib, nyaman, dan berkelanjutan.
                    </p>
                </div>

                <!-- Misi -->
                <div class="glass-card">
                    <h2 class="text-[34px] font-bold mb-10">Misi LingKojan</h2>
                    
                    <div class="space-y-10">
                        <!-- Pelayanan Efektif -->
                        <div class="flex items-start">
                            <div class="icon-circle">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0111 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-sm mb-1">Pelayanan Efektif</h4>
                                <p class="text-[12px] opacity-90 leading-relaxed font-medium">Mendukung proses pengelolaan laporan yang terstruktur agar penanganan masalah berjalan lebih cepat dan tepat.</p>
                            </div>
                        </div>

                        <!-- Kemudahan Akses -->
                        <div class="flex items-start">
                            <div class="icon-circle">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-7.53 6.47a1 1 0 011.06 0 3.5 3.5 0 004.94 0 1 1 0 111.42 1.42 5.5 5.5 0 01-7.42 0 1 1 0 010-1.42z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-sm mb-1">Kemudahan Akses</h4>
                                <p class="text-[12px] opacity-90 leading-relaxed font-medium">Menyediakan layanan pengaduan yang mudah digunakan sehingga masyarakat dapat menyampaikan laporan kapan saja dan di mana saja.</p>
                            </div>
                        </div>

                        <!-- Kolaborasi Masyarakat -->
                        <div class="flex items-start">
                            <div class="icon-circle">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-sm mb-1">Kolaborasi Masyarakat</h4>
                                <p class="text-[12px] opacity-90 leading-relaxed font-medium">Mendorong partisipasi aktif warga dalam menjaga serta meningkatkan kualitas lingkungan bersama.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hubungi Kami Section -->
    <section class="py-24 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold text-black mb-20 tracking-tight">Hubungi Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                <!-- Alamat -->
                <div class="contact-card">
                    <div class="w-16 h-16 bg-[#ffe8d6] rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-[#f07c1b]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h4 class="font-bold text-xl mb-4 text-black">Alamat</h4>
                    <p class="text-[12px] text-gray-500 leading-relaxed font-medium">
                        Jl. Sltpn, RT. 007/RW. 006, Kampung Kojan, Kalideres, Jakarta Barat, Daerah Khusus Ibu Kota Jakarta, 11840
                    </p>
                </div>
                <!-- Telepon -->
                <div class="contact-card">
                    <div class="w-16 h-16 bg-[#ffe8d6] rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-[#f07c1b]" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 005.455 5.455l.774-1.548a1 1 0 011.06-.539l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                    </div>
                    <h4 class="font-bold text-xl mb-4 text-black">Telepon</h4>
                    <p class="text-[12px] text-gray-500 leading-relaxed font-medium">
                        +62
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>
</html>
