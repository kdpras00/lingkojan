@extends('layouts.rw')

@section('title', 'Dashboard Ketua RW')
@section('page_title', 'Dashboard Ketua RW 006')

@section('content')
<div class="space-y-8">
    <div class="mb-4">
        <h3 class="text-xl font-bold text-black tracking-tight">Dashboard Tiket</h3>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <div class="card !p-6 border-b-4 border-orange-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">New</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['new'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">On Progress</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['progress'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-green-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Done</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['done'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-red-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Cancel</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['cancel'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-blue-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['total'] }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        <a href="{{ route('rw.warga.index') }}" class="card !p-8 hover:shadow-md transition-all border border-gray-100 hover:border-[#f07c1b] group block">
            <h4 class="font-bold text-black text-lg mb-2 group-hover:text-[#f07c1b] transition-colors">Data Warga RW 006</h4>
            <p class="text-sm text-gray-500 font-medium">Lihat data warga yang terdaftar di RW 006</p>
        </a>
        <a href="{{ route('rw.pengaduan.index') }}" class="card !p-8 hover:shadow-md transition-all border border-gray-100 hover:border-[#f07c1b] group block">
            <h4 class="font-bold text-black text-lg mb-2 group-hover:text-[#f07c1b] transition-colors">Pengaduan Warga RW 006</h4>
            <p class="text-sm text-gray-500 font-medium">Daftar laporan yang masuk dari warga di wilayah RW 006</p>
        </a>
        <a href="{{ route('rw.petugas.index') }}" class="card !p-8 hover:shadow-md transition-all border border-gray-100 hover:border-[#f07c1b] group block">
            <h4 class="font-bold text-black text-lg mb-2 group-hover:text-[#f07c1b] transition-colors">Data Petugas</h4>
            <p class="text-sm text-gray-500 font-medium">Lihat data Petugas</p>
        </a>
        <a href="{{ route('rw.pengaduan.recap') }}" class="card !p-8 hover:shadow-md transition-all border border-gray-100 hover:border-[#f07c1b] group block">
            <h4 class="font-bold text-black text-lg mb-2 group-hover:text-[#f07c1b] transition-colors">Laporan Rekap Pengaduan RW 006</h4>
            <p class="text-sm text-gray-500 font-medium">Ringkasan laporan pengaduan warga di wilayah RW 006</p>
        </a>
    </div>

    <div class="card !p-10 space-y-8 mt-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-xl font-bold text-black tracking-tight">Dashboard Warga</h3>
        </div>
        
        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100 w-16 text-center">No</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">RT</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jumlah Warga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($wargaStats as $index => $stat)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-black border-r border-gray-100">{{ $stat->rt }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700">{{ $stat->total }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Belum ada data warga.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
