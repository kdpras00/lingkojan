<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LingKojan - Bersama Peduli, Bersama Memperbaiki</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            scroll-behavior: smooth; 
            color: #333; 
            background-image: url("{{ asset('images/banner.png') }}");
            background-size: auto;
            background-repeat: repeat;
            background-attachment: fixed;
        }
        .bg-orange-main { background-color: #f07c1b; }
        .text-orange-main { color: #f07c1b; }

        .hero-section {
            position: relative;
            display: flex;
            align-items: center;
        }

        .cta-banner {
            background-color: #f07c1b;
            background-image: url("{{ asset('images/banner3.png') }}");
            background-size: auto;
            background-position: center;
            background-repeat: repeat;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .step-icon-box {
            width: 70px;
            height: 70px;
            background-color: #ffe8d6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .nav-link {
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav-link:hover { color: #f07c1b; }

        .btn-orange {
            background-color: #f07c1b;
            color: white;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: 600;
            transition: opacity 0.3s, transform 0.3s;
            display: inline-block;
        }
        .btn-orange:hover { opacity: 0.9; transform: translateY(-2px); }

        .btn-white {
            background-color: white;
            color: #f07c1b;
            padding: 10px 40px;
            border-radius: 10px;
            font-weight: 600;
            transition: background 0.3s, transform 0.3s;
            display: inline-block;
        }
        .btn-white:hover { background-color: #f8f8f8; transform: translateY(-2px); }

        /* GSAP initial hidden states */
        .gsap-hidden { opacity: 0; }

        /* Typewriter Cursor */
        .cursor {
            display: inline-block;
            width: 3px;
            background-color: black;
            margin-left: 2px;
            animation: blink 0.8s infinite;
            vertical-align: middle;
            height: 1em;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Swiper Custom */
        .swiper-pagination { bottom: -45px !important; }
        .swiper-pagination-bullet { 
            background: white !important; 
            width: 10px !important; 
            height: 10px !important; 
            opacity: 0.4 !important;
            transition: all 0.3s ease;
        }
        .swiper-pagination-bullet-active { 
            opacity: 1 !important; 
            width: 25px !important; 
            border-radius: 5px !important;
        }
        .latest-complaints-swiper { padding-bottom: 60px !important; }
        .glass-card { height: 100%; }
    </style>
</head>
<body>
    @include('components.navbar')

    <!-- Hero Section -->
    <section id="beranda" class="hero-section py-20 lg:py-40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="lg:w-3/5 text-center lg:text-left mb-12 lg:mb-0">
                <h1 id="hero-h1" class="text-4xl lg:text-5xl font-extrabold text-black leading-tight mb-8">
                    Bersama Peduli, <br>
                    <span id="typewriter" class="text-black"></span><span class="cursor"></span>
                </h1>
                <p id="hero-p" class="text-md lg:text-xl text-gray-600 mb-12 max-w-2xl mx-auto lg:mx-0 leading-relaxed gsap-hidden">
                    Sampaikan aspirasi Anda dengan mudah dan transparan. <br>
                    Kami memastikan setiap suara didengar dan ditindaklanjuti.
                </p>
                <a id="hero-btn" href="/login" class="btn-orange px-12 py-4 rounded-xl text-lg gsap-hidden">
                    Sampaikan Pengaduan
                </a>
            </div>
            <div class="lg:w-2/5 flex justify-center lg:justify-end">
                <img id="hero-img" src="{{ asset('images/iconphone.png') }}" alt="Hero Illustration" class="w-full max-w-md lg:max-w-lg gsap-hidden">
            </div>
        </div>
    </section>

    <!-- Pengaduan Terbaru Section -->
    <section class="complaints-section bg-orange-main py-28 lg:py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="complaints-title text-3xl lg:text-4xl font-bold text-white mb-4 tracking-tight">Pengaduan Terbaru</h2>
            <p class="complaints-subtitle text-white opacity-90 mb-16 text-lg">Lihat pengaduan terbaru yang telah disampaikan oleh masyarakat.</p>

            <div class="relative">
                <div class="swiper latest-complaints-swiper">
                    <div class="swiper-wrapper">
                        @forelse($latestPengaduans as $pengaduan)
                            @php 
                                $firstDetail = $pengaduan->details->first();
                                $latestDetail = $pengaduan->details->last();
                            @endphp
                            <div class="swiper-slide h-auto">
                                <div class="glass-card p-6 text-white text-left flex flex-col justify-between">
                                    <div>
                                        <!-- Complaint Image -->
                                        @php
                                            $fotoAwal = $firstDetail->fotos->first();
                                        @endphp
                                        <div class="w-full h-44 bg-white/10 rounded-2xl overflow-hidden mb-5 border border-white/10 relative flex items-center justify-center">
                                            @if($fotoAwal)
                                                <img src="{{ asset('storage/' . $fotoAwal->nama_file) }}" class="w-full h-full object-cover" alt="Foto Pengaduan">
                                            @else
                                                <div class="flex flex-col items-center justify-center text-white/40 space-y-2">
                                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <span class="text-[10px] font-bold uppercase tracking-wider">Tidak ada foto</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Reporter & Date -->
                                        <div class="flex items-center justify-between mb-4 text-xs font-semibold">
                                            <span class="opacity-95">Oleh: {{ $firstDetail->user->nama_warga ?? 'Anonim' }}</span>
                                            <span class="opacity-75 text-[11px]">{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d M Y') }}</span>
                                        </div>

                                        <!-- Subject -->
                                        <p class="text-sm mb-6 leading-relaxed font-bold line-clamp-3 h-12 text-white">
                                            {{ $pengaduan->subject }}
                                        </p>
                                    </div>

                                    <!-- Footer -->
                                    <div class="flex justify-between items-center pt-5 border-t border-white/10 mt-auto">
                                        <a href="/login" class="text-[11px] font-bold uppercase tracking-widest hover:text-white transition-all opacity-80 hover:opacity-100">Detail ></a>
                                        
                                        <span class="text-[11px] font-bold uppercase tracking-widest text-white/90">
                                            Status: <span class="text-white">{{ $latestDetail->status->status ?? 'New' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="glass-card p-10 flex items-center justify-center text-white/60">
                                    Belum ada pengaduan terbaru.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- Pagination moved here -->
                <div class="swiper-pagination !static mt-8"></div>
            </div>
        </div>
    </section>

    <!-- Bagaimana Cara Kerjanya? Section -->
    <section id="tentang" class="how-section py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="how-title text-4xl font-bold text-black mb-6">Bagaimana Cara Kerjanya?</h2>
            <p class="how-subtitle text-gray-500 max-w-2xl mx-auto mb-20 leading-relaxed text-sm">
                LingKojan menghadirkan alur pengaduan yang praktis dan efisien, membantu Anda melaporkan permasalahan lingkungan tanpa proses yang rumit.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-12">
                <!-- Step 1 -->
                <div class="step-item">
                    <div class="step-icon-box">
                        <svg class="w-8 h-8 text-orange-main" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h4 class="font-bold text-sm mb-2 text-black">1. Login</h4>
                    <p class="text-[10px] text-gray-400 px-4">Daftar untuk mulai menggunakan layanan LingKojan.</p>
                </div>
                <!-- Step 2 -->
                <div class="step-item">
                    <div class="step-icon-box">
                        <svg class="w-8 h-8 text-orange-main" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                    <h4 class="font-bold text-sm mb-2 text-black">2. Buat Pengaduan</h4>
                    <p class="text-[10px] text-gray-400 px-4">Tuliskan keluhan Anda dan lampirkan bukti jika tersedia.</p>
                </div>
                <!-- Step 3 -->
                <div class="step-item">
                    <div class="step-icon-box">
                        <svg class="w-8 h-8 text-orange-main" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-sm mb-2 text-black">3. Verifikasi</h4>
                    <p class="text-[10px] text-gray-400 px-4">Laporan diperiksa sebelum diteruskan ke petugas terkait.</p>
                </div>
                <!-- Step 4 -->
                <div class="step-item">
                    <div class="step-icon-box">
                        <svg class="w-8 h-8 text-orange-main" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </div>
                    <h4 class="font-bold text-sm mb-2 text-black">4. Tindak Lanjut</h4>
                    <p class="text-[10px] text-gray-400 px-4">Petugas menangani laporan sesuai permasalahan.</p>
                </div>
                <!-- Step 5 -->
                <div class="step-item">
                    <div class="step-icon-box">
                        <svg class="w-8 h-8 text-orange-main" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-sm mb-2 text-black">5. Selesai</h4>
                    <p class="text-[10px] text-gray-400 px-4">Laporan selesai ditangani dan Anda akan menerima notifikasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Banner -->
    <section class="cta-section cta-banner py-32 lg:py-40 text-center text-white">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="cta-title text-4xl font-bold mb-4 tracking-tight">Siap Menyampaikan Aspirasi Anda?</h2>
            <p class="cta-subtitle text-sm opacity-90 mb-12 max-w-xl mx-auto">
                Sampaikan laporan Anda dan bantu menciptakan lingkungan yang lebih baik bersama LingKojan.
            </p>
            <a href="/login" class="cta-btn btn-white">Masuk</a>
        </div>
    </section>
    @include('components.footer')


    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/TextPlugin.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Register Plugins
        gsap.registerPlugin(ScrollTrigger, TextPlugin);



        // ─────────────────────────────────────────────
        // 2. HERO — Staggered entrance timeline
        // ─────────────────────────────────────────────
        const heroTl = gsap.timeline({ defaults: { ease: "power3.out" } });

        heroTl
            .to("#hero-h1", {
                x: 0, opacity: 1, duration: 0.8,
                onStart: () => gsap.set("#hero-h1", { x: -60 })
            })
            .to("#hero-p", {
                x: 0, opacity: 1, duration: 0.7,
                onStart: () => gsap.set("#hero-p", { x: -50 })
            }, "-=0.4")
            .to("#hero-btn", {
                scale: 1, opacity: 1, duration: 0.5,
                onStart: () => gsap.set("#hero-btn", { scale: 0.8 })
            }, "-=0.3")
            .to("#hero-img", {
                x: 0, opacity: 1, duration: 0.9,
                onStart: () => gsap.set("#hero-img", { x: 80 })
            }, "<-0.5");

        // ─────────────────────────────────────────────
        // 3. HERO — Continuous loops
        // ─────────────────────────────────────────────
        // Image floating loop
        gsap.to("#hero-img", {
            y: -18,
            duration: 2.5,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut",
            delay: 1.5
        });

        // Typewriter Effect
        gsap.to("#typewriter", {
            duration: 2.5,
            text: "Bersama Memperbaiki",
            repeat: -1,
            yoyo: true,
            repeatDelay: 1.5,
            ease: "none",
            delay: 1
        });

        // ─────────────────────────────────────────────
        // 4. PENGADUAN TERBARU — Scroll reveal
        // ─────────────────────────────────────────────
        gsap.from(".complaints-title, .complaints-subtitle", {
            scrollTrigger: {
                trigger: ".complaints-section",
                start: "top 80%",
            },
            y: 40,
            opacity: 0,
            duration: 0.7,
            stagger: 0.15,
            ease: "power3.out"
        });

        gsap.from(".glass-card", {
            scrollTrigger: {
                trigger: ".complaints-section",
                start: "top 65%",
            },
            y: 60,
            opacity: 0,
            duration: 0.7,
            stagger: 0.15,
            ease: "power3.out"
        });

        // ─────────────────────────────────────────────
        // 5. CARA KERJANYA — Staggered step reveal
        // ─────────────────────────────────────────────
        gsap.from(".how-title, .how-subtitle", {
            scrollTrigger: {
                trigger: ".how-section",
                start: "top 80%",
            },
            y: 40,
            opacity: 0,
            duration: 0.7,
            stagger: 0.15,
            ease: "power3.out"
        });

        gsap.from(".step-item", {
            scrollTrigger: {
                trigger: ".how-section",
                start: "top 65%",
            },
            y: 50,
            opacity: 0,
            duration: 0.6,
            stagger: 0.12,
            ease: "back.out(1.7)"
        });

        gsap.from(".step-icon-box", {
            scrollTrigger: {
                trigger: ".how-section",
                start: "top 60%",
            },
            scale: 0,
            opacity: 0,
            duration: 0.5,
            stagger: 0.12,
            ease: "back.out(2.5)"
        });

        // ─────────────────────────────────────────────
        // 6. CTA BANNER — Fade + scale reveal
        // ─────────────────────────────────────────────
        gsap.from(".cta-title", {
            scrollTrigger: {
                trigger: ".cta-section",
                start: "top 80%",
            },
            y: 40,
            opacity: 0,
            duration: 0.8,
            ease: "power3.out"
        });

        gsap.from(".cta-subtitle", {
            scrollTrigger: {
                trigger: ".cta-section",
                start: "top 75%",
            },
            y: 30,
            opacity: 0,
            duration: 0.7,
            delay: 0.15,
            ease: "power3.out"
        });

        gsap.from(".cta-btn", {
            scrollTrigger: {
                trigger: ".cta-section",
                start: "top 70%",
            },
            scale: 0.85,
            opacity: 0,
            duration: 0.6,
            delay: 0.3,
            ease: "back.out(1.5)"
        });

        // ─────────────────────────────────────────────
        // 7. SWIPER — Complaints Carousel
        // ─────────────────────────────────────────────
        new Swiper('.latest-complaints-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            speed: 1000, // Slower transition animation
            autoplay: {
                delay: 5000, // Slower delay between slides
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    </script>
</body>
</html>
