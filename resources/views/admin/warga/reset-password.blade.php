@extends('layouts.admin')

@section('title', 'Reset Password Warga')
@section('page_title', 'Reset Password')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('admin.warga.index') }}" class="hover:text-[#f07c1b]">Kelola Data Warga</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Reset Password</span>
    </div>

    <div class="flex justify-center py-10">
        <div class="card w-full max-w-xl !p-12 shadow-2xl">
            <div class="mb-10 text-center">
                <h3 class="text-xl font-black text-black tracking-tight uppercase">Reset Password</h3>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-2">Update security credentials</p>
            </div>

            <form action="#" method="POST" class="space-y-8">
                <!-- Password Baru -->
                <div class="space-y-3">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Password Baru</label>
                    <div class="group">
                        <input type="password" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Min. 8 karakter">
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-3">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                    <div class="group">
                        <input type="password" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Ulangi password baru">
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-6 pt-6 border-t border-gray-50">
                    <a href="{{ route('admin.warga.edit', 1) }}" class="px-8 py-3 rounded-none text-[11px] font-black uppercase tracking-widest text-gray-500 border-2 border-transparent hover:border-black transition-all">Batal</a>
                    <button type="button" class="bg-white border-2 border-black text-black px-10 py-3 rounded-none text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] flex items-center group/btn">
                        Simpan Password
                        <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
