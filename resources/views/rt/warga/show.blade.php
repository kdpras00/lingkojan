@extends('layouts.rt')

@section('title', 'Detail Warga')
@section('page_title', 'Detail Warga')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rt.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('rt.warga.index') }}" class="hover:text-[#f07c1b]">Data Warga</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Detail</span>
    </div>

    <div class="card !p-0 overflow-hidden">
        <div class="bg-gray-50/50 px-10 py-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-xl font-black text-black tracking-tight uppercase">Detail User</h3>
        </div>
        
        <div class="p-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-12">
                <!-- Row 1 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Username</label>
                    <p class="text-sm font-bold text-gray-700">{{ $warga->username }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Email</label>
                    <p class="text-sm font-bold text-gray-700">{{ $warga->email }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Alamat</label>
                    <p class="text-sm font-bold text-gray-700">{{ $warga->address ?? $warga->alamat ?? '-' }}, RT {{ $warga->rt }}/RW {{ $warga->rw ?? '006' }}</p>
                </div>

                <!-- Row 2 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama</label>
                    <p class="text-sm font-bold text-gray-700">{{ $warga->name }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">No. HP</label>
                    <p class="text-sm font-bold text-gray-700 tracking-wider">{{ $warga->phone ?? '-' }}</p>
                </div>
                <div>
                    <!-- Empty space to align Alamat -->
                </div>

                <!-- Row 3 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">NIK</label>
                    <p class="text-sm font-bold text-gray-700 tracking-widest">{{ $warga->nik ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">RT/RW</label>
                    <p class="text-sm font-bold text-gray-700 tracking-widest">{{ $warga->rt }}/{{ $warga->rw ?? '006' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
