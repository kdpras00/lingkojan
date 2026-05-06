@extends('layouts.rw')

@section('title', 'Kelola Data Warga')
@section('page_title', 'Kelola Data Warga')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rw.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Kelola Data Warga</span>
    </div>

    <!-- Filter Section (Wireframe 41) -->
    <div class="card !p-8 shadow-sm">
        <form action="{{ route('rw.warga.index') }}" method="GET" class="space-y-6">
            <div class="flex items-center">
                <h4 class="text-sm font-bold text-black uppercase tracking-widest">Filter Warga</h4>
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end gap-6">
                <div class="flex-1 max-w-xs">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">RT</label>
                    <select name="rt" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat">
                        <option value="">Semua RT</option>
                        @foreach($availableRts as $art)
                            <option value="{{ $art }}" {{ request('rt') == $art ? 'selected' : '' }}>RT {{ $art }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-black text-white px-8 py-3.5 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-all shadow-md">Terapkan Filter</button>
            </div>
        </form>
    </div>

    <div class="card !p-10 space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-gray-100 pb-8">
            <div>
                <h3 class="text-2xl font-bold text-black tracking-tight">Daftar Warga</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola data masyarakat LingKojan</p>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nama</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Username</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">NIK</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">No. Telepon</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Email</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">RT</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($wargas as $index => $warga)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-black border-r border-gray-100">{{ $warga->name }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $warga->username }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-600 border-r border-gray-100 tracking-wider">{{ $warga->nik }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $warga->phone }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $warga->email }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $warga->rt ?: '-' }}</td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('rw.warga.show', $warga->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors inline-block" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Belum ada data warga.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
