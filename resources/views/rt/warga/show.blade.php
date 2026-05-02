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

    <div class="card !p-10 space-y-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-black text-black tracking-tight uppercase">Detail User</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
            <!-- Username -->
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">Username</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-semibold text-gray-600 shadow-sm">{{ $warga->username }}</div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">Email</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-semibold text-gray-600 shadow-sm">{{ $warga->email }}</div>
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">Nama</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-semibold text-gray-600 shadow-sm">{{ $warga->name }}</div>
            </div>

            <!-- No. HP -->
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">No. HP</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-semibold text-gray-600 shadow-sm">{{ $warga->phone ?? '-' }}</div>
            </div>

            <!-- NIK -->
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">NIK</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-semibold text-gray-600 shadow-sm">{{ $warga->nik ?? '-' }}</div>
            </div>

            <!-- RT/RW -->
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">RT/RW</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-semibold text-gray-600 shadow-sm">{{ $warga->rt }}/006</div>
            </div>

            <!-- Alamat (Full Width) -->
            <div class="md:col-span-2">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 uppercase">Alamat</label>
                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-8 py-6 text-sm font-semibold text-gray-600 shadow-sm leading-relaxed">
                    {{ $warga->alamat ?? 'Alamat belum diisi.' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
