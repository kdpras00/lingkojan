@extends('layouts.admin')

@section('title', 'Detail User Admin')
@section('page_title', 'Detail User')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('admin.users.index') }}" class="hover:text-[#f07c1b]">Kelola Data Admin</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Detail</span>
    </div>

    <div class="card !p-0 overflow-hidden">
        <div class="bg-gray-50/50 px-10 py-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-xl font-black text-black tracking-tight uppercase">Detail User</h3>
            <div class="flex space-x-3">
                <a href="#" class="text-[10px] font-black uppercase text-orange-600 hover:underline">Edit Data</a>
            </div>
        </div>
        
        <div class="p-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-12">
                <!-- Row 1 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Username</label>
                    <p class="text-sm font-bold text-gray-700">admin</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Email</label>
                    <p class="text-sm font-bold text-gray-700">admin@gmail.com</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Alamat</label>
                    <p class="text-sm font-bold text-gray-700">Kampung Kojan, RT 001/RW 006</p>
                </div>

                <!-- Row 2 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama</label>
                    <p class="text-sm font-bold text-gray-700">Admin System</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">No. HP</label>
                    <p class="text-sm font-bold text-gray-700 tracking-wider">082830273458</p>
                </div>

                <!-- Row 3 -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">NIK</label>
                    <p class="text-sm font-bold text-gray-700 tracking-widest">3302147890261567</p>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3">RT/RW</label>
                    <p class="text-sm font-bold text-gray-700">001/006</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
