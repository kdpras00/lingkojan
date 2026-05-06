@extends('layouts.admin')

@section('title', 'Edit Data Ketua RT')
@section('page_title', 'Edit Data Ketua RT')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('admin.ketua_rt.index') }}" class="hover:text-[#f07c1b]">Kelola Data Ketua RT</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Edit</span>
    </div>

    <div class="flex justify-center py-10">
        <div class="card w-full max-w-xl !p-12 shadow-2xl">
            <form action="{{ route('admin.ketua_rt.update', $ketuaRt->id) }}" method="POST" class="space-y-10">
                @csrf
                @method('PUT')
                <div class="flex items-center space-x-10">
                    <label class="text-sm font-black text-black uppercase tracking-widest w-40">RT</label>
                    <div class="flex-1 group">
                        <select name="rt" class="w-full bg-gray-50 border @error('rt') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat">
                            <option value="" @if(old('rt', $ketuaRt->rt) == '') selected @endif disabled>Pilih RT</option>
                            @foreach($rts as $rt_data)
                                <option value="{{ $rt_data->nomor }}" {{ old('rt', $ketuaRt->rt) == $rt_data->nomor ? 'selected' : '' }}>{{ $rt_data->nomor }}</option>
                            @endforeach
                        </select>
                        @error('rt') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-10">
                    <label class="text-sm font-black text-black uppercase tracking-widest w-40">Username</label>
                    <div class="flex-1 group">
                        <input type="text" name="username" value="{{ old('username', $ketuaRt->username) }}" class="w-full bg-gray-50 border @error('username') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="sarudin">
                        @error('username') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-10">
                    <label class="text-sm font-black text-black uppercase tracking-widest w-40">Nama</label>
                    <div class="flex-1 group">
                        <input type="text" name="name" value="{{ old('name', $ketuaRt->name) }}" class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Sarudin Akmal">
                        @error('name') <span class="text-xs text-red-500 mt-1 ml-1 font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-8 mt-4 border-t border-gray-100">
                    <a href="{{ route('admin.ketua_rt.index') }}" class="px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-gray-600 border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition-all">BATAL</a>
                    <button type="submit" class="bg-black text-white px-10 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl flex items-center group/btn">
                        SIMPAN
                        <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
