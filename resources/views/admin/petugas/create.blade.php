@extends('layouts.admin')

@section('title', 'Tambah User Petugas')
@section('page_title', 'Tambah User')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('admin.petugas.index') }}" class="hover:text-[#f07c1b]">Kelola Data Petugas</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Tambah User</span>
    </div>

    <div class="card !p-12">
        <form action="{{ route('admin.petugas.store') }}" method="POST" class="space-y-12">
            @csrf
            <!-- Section: Data Pribadi -->
            <div>
                <div class="border-b-2 border-gray-100 pb-4 mb-8">
                    <h3 class="text-xl font-black text-black tracking-tight uppercase">Data Pribadi</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Masukkan nama lengkap">
                        @error('name') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" minlength="16" pattern="[0-9]{16}" inputmode="numeric" title="NIK harus tepat 16 digit angka" class="w-full bg-gray-50 border @error('nik') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Masukkan 16 digit NIK">
                        @error('nik') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full bg-gray-50 border @error('alamat') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Masukkan alamat lengkap">
                        @error('alamat') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">No. HP</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" maxlength="15" minlength="10" pattern="0[0-9]{9,14}" inputmode="numeric" title="Nomor HP harus 10-15 digit dan diawali 0" class="w-full bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Contoh: 0812xxxx">
                        @error('phone') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Informasi Akun -->
            <div>
                <div class="border-b-2 border-gray-100 pb-4 mb-8">
                    <h3 class="text-xl font-black text-black tracking-tight uppercase">Informasi Akun</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="w-full bg-gray-50 border @error('username') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Masukkan username">
                        @error('username') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Contoh: petugas@gmail.com">
                        @error('email') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                        <input type="password" name="password" class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Min. 8 karakter, kombinasi huruf & angka">
                        @error('password') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-8 mt-4 border-t border-gray-100">
                <a href="{{ route('admin.petugas.index') }}" class="px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-gray-600 border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition-all">Batal</a>
                <button type="submit" class="bg-black text-white px-12 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl flex items-center group/btn">
                    Tambah
                    <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
