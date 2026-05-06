@extends('layouts.rw')

@section('title', 'Detail Petugas')
@section('page_title', 'Detail Petugas')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rw.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('rw.petugas.index') }}" class="hover:text-[#f07c1b]">Data Petugas</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Detail</span>
    </div>

    <div class="card !p-0 overflow-hidden">
        <div class="bg-gray-50/50 px-10 py-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-xl font-black text-black tracking-tight uppercase">Detail Petugas</h3>
        </div>
        
        <div class="p-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-12">
                <!-- Row 1 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Username</label>
                    <p class="text-sm font-bold text-gray-700">{{ $petugas->username }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Email</label>
                    <p class="text-sm font-bold text-gray-700">{{ $petugas->email }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Alamat</label>
                    <p class="text-sm font-bold text-gray-700">{{ $petugas->address ?? $petugas->alamat ?? '-' }}</p>
                </div>

                <!-- Row 2 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                    <p class="text-sm font-bold text-gray-700">{{ $petugas->name }}</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">No. Telepon</label>
                    <p class="text-sm font-bold text-gray-700 tracking-wider">{{ $petugas->phone ?? '-' }}</p>
                </div>
                <div>
                    <!-- Empty space -->
                </div>

                <!-- Row 3 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">NIK</label>
                    <p class="text-sm font-bold text-gray-700 tracking-widest">{{ $petugas->nik ?? '-' }}</p>
                </div>
                <div>
                    <!-- Empty space -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
