@extends('layouts.rw')

@section('title', 'Kelola Data Petugas')
@section('page_title', 'Kelola Data Petugas')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rw.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Kelola Data Petugas</span>
    </div>

    <div class="card !p-10 space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-gray-100 pb-8">
            <div>
                <h3 class="text-2xl font-black text-black tracking-tight">Daftar Petugas</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola data petugas lapangan LingKojan</p>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Username</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nama Lengkap</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">NIK</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">No. Telepon</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($petugas as $index => $item)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $item->username }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-black border-r border-gray-100">{{ $item->name }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-600 border-r border-gray-100 tracking-wider">{{ $item->nik }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 tracking-wider">{{ $item->phone }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $item->email }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Belum ada data Petugas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
