@extends('layouts.admin')

@section('title', 'Tambah Data RT')
@section('page_title', 'Tambah Data RT')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('admin.rt.index') }}" class="hover:text-[#f07c1b]">Data RT</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Tambah</span>
    </div>

    <div class="flex justify-center py-10">
        <div class="card w-full max-w-xl !p-12 shadow-2xl">
            <form action="{{ route('admin.rt.store') }}" method="POST" class="space-y-10">
                @csrf
                <div class="flex items-center space-x-10">
                    <label class="text-sm font-black text-black uppercase tracking-widest w-40">Nomor RT</label>
                    <div class="flex-1 group">
                        <input type="text" name="nomor" value="{{ old('nomor') }}" class="w-full bg-gray-50 border @error('nomor') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Contoh: 003">
                        @error('nomor') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-10">
                    <label class="text-sm font-black text-black uppercase tracking-widest w-40">Nama Ketua (Opsional)</label>
                    <div class="flex-1 group">
                        <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}" class="w-full bg-gray-50 border @error('nama_ketua') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Nama Ketua RT">
                        @error('nama_ketua') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-8 mt-4 border-t border-gray-100">
                    <a href="{{ route('admin.rt.index') }}" class="px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-gray-600 border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition-all">Batal</a>
                    <button type="submit" class="bg-black text-white px-10 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl flex items-center group/btn">
                        Tambah
                        <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
