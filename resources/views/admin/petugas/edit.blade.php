@extends('layouts.admin')

@section('title', 'Edit User Petugas')
@section('page_title', 'Edit User')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('admin.petugas.index') }}" class="hover:text-[#f07c1b]">Kelola Data Petugas</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Edit</span>
    </div>

    <div class="card !p-12">
        <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST" class="space-y-12">
            @csrf
            @method('PUT')
            <!-- Section: Data Pribadi -->
            <div>
                <div class="border-b-2 border-gray-100 pb-4 mb-8 flex items-center justify-between">
                    <h3 class="text-xl font-black text-black tracking-tight uppercase">Data Pribadi</h3>
                    <button type="button" onclick="toggleModal('modalResetPassword')" class="bg-orange-500 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 transition-all shadow-lg flex items-center group/reset-btn">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        Reset Password
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $petugas->name) }}" class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
                        @error('name') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $petugas->nik) }}" class="w-full bg-gray-50 border @error('nik') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
                        @error('nik') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $petugas->alamat) }}" class="w-full bg-gray-50 border @error('alamat') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
                        @error('alamat') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">No. HP</label>
                        <input type="text" name="phone" value="{{ old('phone', $petugas->phone) }}" class="w-full bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
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
                        <input type="text" name="username" value="{{ old('username', $petugas->username) }}" class="w-full bg-gray-50 border @error('username') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
                        @error('username') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $petugas->email) }}" class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
                        @error('email') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-8 mt-4 border-t border-gray-100">
                <a href="{{ route('admin.petugas.index') }}" class="px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-gray-600 border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition-all">Batal</a>
                <button type="submit" class="bg-black text-white px-12 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl flex items-center group/btn">
                    Simpan Perubahan
                    <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="modalResetPassword" class="fixed inset-0 z-[9999] {{ $errors->has('password') ? '' : 'hidden' }}">
    <!-- Blur Background -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-md transition-opacity"></div>
    
    <!-- Modal Content -->
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-lg overflow-hidden transform transition-all">
            <div class="p-12">
                <div class="mb-10 text-center">
                    <h3 class="text-2xl font-black text-black tracking-tight uppercase">Reset Password</h3>
                </div>

                <form action="{{ route('admin.petugas.update_password', $petugas->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-3">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Password Baru</label>
                        <div class="group">
                            <input type="password" name="password" required class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Min. 8 karakter">
                            @error('password') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                        <div class="group">
                            <input type="password" name="password_confirmation" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-6 pt-6 border-t border-gray-50">
                        <button type="button" onclick="toggleModal('modalResetPassword')" class="px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-gray-600 border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition-all">Batal</button>
                        <button type="submit" class="bg-black text-white px-10 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl flex items-center group/modal-btn">
                            Simpan Password
                            <svg class="w-4 h-4 ml-3 transform group-hover/modal-btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal when clicking background
    document.getElementById('modalResetPassword').addEventListener('click', function(e) {
        if (e.target === this) toggleModal('modalResetPassword');
    });
</script>
@endpush
@endsection
