@extends('layouts.warga')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Warga')

@section('styles')
<style>
    .welcome-card {
        background: #f07c1b;
        background-image: url("{{ asset('images/banner3.png') }}");
        background-size: cover;
        background-blend-mode: overlay;
        border-radius: 30px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(240, 124, 27, 0.2);
    }
    .stat-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
    .info-box {
        background: #fff8e1;
        border-left: 4px solid #f07c1b;
        border-radius: 15px;
    }
</style>
@endsection

@section('content')

<!-- Welcome Banner -->
<!-- <div class="welcome-card">
    <h2 class="text-3xl font-bold mb-2 uppercase tracking-tight">Halo, {{ auth()->user()->name }}!</h2>
    <p class="text-orange-100 font-medium">Selamat datang di LingKojan. Pantau perkembangan laporan Anda di sini.</p>
</div> -->

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stat-card card !p-6 border-l-4 border-blue-500">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Laporan</p>
        <h3 class="text-2xl font-bold text-black">{{ $stats['total'] }}</h3>
    </div>
    <div class="stat-card card !p-6 border-l-4 border-orange-500">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Dalam Proses</p>
        <h3 class="text-2xl font-bold text-black">{{ $stats['process'] }}</h3>
    </div>
    <div class="stat-card card !p-6 border-l-4 border-green-500">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Selesai</p>
        <h3 class="text-2xl font-bold text-black">{{ $stats['done'] }}</h3>
    </div>
    <div class="stat-card card !p-6 border-l-4 border-red-500">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Dibatalkan</p>
        <h3 class="text-2xl font-bold text-black">{{ $stats['cancel'] }}</h3>
    </div>
</div>

<div class="card mt-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h4 class="font-bold text-xl text-black">Pengaduan Saya</h4>
            <p class="text-sm text-gray-500">Lihat semua laporan yang telah Anda buat</p>
        </div>
        <a href="{{ route('warga.pengaduan.create') }}" class="bg-white border-2 border-black text-black px-6 py-2.5 rounded-none text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Pengaduan
        </a>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="px-4 py-4 font-semibold text-xs text-gray-700 uppercase tracking-wider border-r border-gray-200">No</th>
                    <th class="px-4 py-4 font-semibold text-xs text-gray-700 uppercase tracking-wider border-r border-gray-200">Tanggal Pengaduan</th>
                    <th class="px-4 py-4 font-semibold text-xs text-gray-700 uppercase tracking-wider border-r border-gray-200">Nomor Pengaduan</th>
                    <th class="px-4 py-4 font-semibold text-xs text-gray-700 uppercase tracking-wider border-r border-gray-200">Kategori</th>
                    <th class="px-4 py-4 font-semibold text-xs text-gray-700 uppercase tracking-wider border-r border-gray-200">Subject</th>
                    <th class="px-4 py-4 font-semibold text-xs text-gray-700 uppercase tracking-wider border-r border-gray-200">Last Status</th>
                    <th class="px-4 py-4 font-bold text-xs text-gray-700 uppercase tracking-wider">Menu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($myPengaduans as $index => $pengaduan)
                <tr class="hover:bg-gray-50 transition-all">
                    <td class="px-4 py-4 text-sm text-gray-600 border-r border-gray-100">{{ $index + 1 }}</td>
                    <td class="px-4 py-4 text-sm text-gray-600 border-r border-gray-100">{{ \Carbon\Carbon::parse($pengaduan->details->first()->tgl)->format('d-m-Y H:i') }}</td>
                    <td class="px-4 py-4 text-sm font-semibold text-black border-r border-gray-100">{{ $pengaduan->nomor_pengaduan }}</td>
                    <td class="px-4 py-4 text-sm text-gray-600 border-r border-gray-100">{{ $pengaduan->kategori->kategori ?? '-' }}</td>
                    <td class="px-4 py-4 text-sm text-gray-600 border-r border-gray-100">{{ $pengaduan->subject }}</td>
                    <td class="px-4 py-4 border-r border-gray-100">
                        @php
                            $currentStatus = $pengaduan->details->last()->status->status ?? 'Unknown';
                        @endphp
                        <span class="text-black text-[10px] font-bold uppercase tracking-widest">
                            {{ $currentStatus }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <a href="{{ route('warga.pengaduan.show', $pengaduan->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                            <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-10 text-center text-sm font-bold text-gray-400">Anda belum pernah membuat pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
