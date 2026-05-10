<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Pengaduan - LingKojan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 1.5cm;
            }
            .no-print {
                display: none !important;
            }
            body {
                -webkit-print-color-adjust: exact;
                background-color: white !important;
            }
            .print-border {
                border: 2px solid black !important;
            }
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="p-0 md:p-10">
    <!-- Print Button (Visible only on screen) -->
    <div class="max-w-4xl mx-auto mb-6 no-print flex justify-end">
        <button onclick="window.print()" class="bg-white border-2 border-black text-black px-8 py-3 rounded-none text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Laporan
        </button>
    </div>

    <div class="max-w-[21cm] mx-auto bg-white p-[1.5cm] shadow-xl print:shadow-none print:p-0">
        <!-- Header -->
        <div class="flex items-center border-b-2 border-black pb-6 mb-8">
            <div class="w-24">
                <img src="{{ asset('images/iconkojan.png') }}" alt="Logo" class="w-full h-auto">
            </div>
            <div class="flex-1 text-center">
                <h1 class="text-xl font-black uppercase leading-tight">Sekretariat RW 006</h1>
                <h2 class="text-sm font-bold uppercase tracking-tight">Kampung Kojan, Kalideres, Jakarta Barat</h2>
                <h3 class="text-2xl font-black mt-1">LINGKOJAN</h3>
                <h4 class="text-xs font-bold uppercase mt-1">Layanan Pengaduan Masyarakat</h4>
                <p class="text-[10px] mt-1 font-medium leading-tight">
                    Jl. Sltpn, RT. 007/RW. 006, Kampung Kojan, Kalideres, Jakarta Barat<br>
                    Daerah Khusus Ibu Kota Jakarta, 11840
                </p>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Section A: Profil Pelapor -->
            @php
                $pelapor = $pengaduan->details->sortBy('id')->first()->user;
            @endphp
            <div class="border border-black overflow-hidden">
                <div class="bg-black text-white px-4 py-2 text-sm font-bold uppercase tracking-widest">
                    A. Profil Pelapor
                </div>
                <table class="w-full text-sm border-collapse">
                    <tr class="border-t border-black">
                        <td class="w-1/3 px-4 py-2 font-bold border-r border-black bg-gray-50">Nama</td>
                        <td class="px-4 py-2">{{ $pelapor->nama_warga }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">Username</td>
                        <td class="px-4 py-2">{{ $pelapor->username ?? '-' }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">NIK</td>
                        <td class="px-4 py-2 tracking-widest">{{ $pelapor->nik ?? '-' }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">No. Telepon</td>
                        <td class="px-4 py-2">{{ $pelapor->no_tlp ?? '-' }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">Email</td>
                        <td class="px-4 py-2">{{ $pelapor->email }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">RT/RW</td>
                        <td class="px-4 py-2">{{ $pelapor->rt->nama_rt ?? '-' }}/006</td>
                    </tr>
                </table>
            </div>

            <!-- Section B: Informasi Pengaduan -->
            <div class="border border-black overflow-hidden">
                <div class="bg-black text-white px-4 py-2 text-sm font-bold uppercase tracking-widest">
                    B. Informasi Pengaduan
                </div>
                <table class="w-full text-sm border-collapse">
                    <tr class="border-t border-black">
                        <td class="w-1/3 px-4 py-2 font-bold border-r border-black bg-gray-50">Nomor Pengaduan</td>
                        <td class="px-4 py-2 font-black">{{ $pengaduan->nomor_pengaduan }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">Tanggal Pengaduan</td>
                        <td class="px-4 py-2">{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">Kategori</td>
                        <td class="px-4 py-2">{{ $pengaduan->kategori->kategori ?? '-' }}</td>
                    </tr>
                    <tr class="border-t border-black">
                        <td class="px-4 py-2 font-bold border-r border-black bg-gray-50">Status Terakhir</td>
                        <td class="px-4 py-2 font-bold uppercase">{{ $pengaduan->details->sortByDesc('id')->first()->status->status ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Section C: Isi Laporan -->
            <div class="border border-black overflow-hidden">
                <div class="bg-black text-white px-4 py-2 text-sm font-bold uppercase tracking-widest">
                    C. Isi Laporan
                </div>
                <div class="px-4 py-2 font-bold border-b border-black bg-gray-50 text-xs">Subjek: {{ $pengaduan->subject }}</div>
                <div class="px-4 py-4 text-sm leading-relaxed">
                    "{{ $pengaduan->details->sortBy('id')->first()->detail_pengaduan }}"
                </div>
            </div>

            <!-- Section D: Bukti Laporan -->
            @php
                $firstFoto = $pengaduan->details->sortBy('id')->first()->fotos->first();
            @endphp
            @if($firstFoto)
            <div class="border border-black overflow-hidden">
                <div class="bg-black text-white px-4 py-2 text-sm font-bold uppercase tracking-widest">
                    D. Bukti Laporan
                </div>
                <div class="px-4 py-6 flex justify-center">
                    <img src="{{ asset('storage/' . $firstFoto->nama_file) }}" alt="Bukti Laporan" class="max-h-64 border border-gray-200">
                </div>
            </div>
            @endif

            <!-- Signature -->
            <div class="flex justify-end mt-16 pb-12">
                <div class="text-center w-64">
                    <p class="text-sm font-medium">Jakarta, {{ date('d F Y') }}</p>
                    <p class="text-sm font-bold mb-20 uppercase tracking-widest">Pelapor</p>
                    <p class="text-sm font-black border-b border-black inline-block pb-1">{{ $pelapor->nama_warga }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
