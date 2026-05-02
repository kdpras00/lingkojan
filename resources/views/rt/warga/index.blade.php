@extends('layouts.rt')

@section('title', 'Data Warga RT ' . $userRt)
@section('page_title', 'Data Warga RT ' . $userRt)

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rt.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Data Warga</span>
    </div>

    <!-- Data Warga Table Card -->
    <div class="card !p-10 space-y-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-black text-black tracking-tight">Daftar Warga RT {{ $userRt }}</h3>
            <p class="text-sm text-gray-500 font-medium mt-1">Data warga terdaftar di wilayah RT {{ $userRt }}.</p>
        </div>

        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-5 border-r border-gray-100 text-center w-16">No</th>
                        <th class="px-6 py-5 border-r border-gray-100">Nama</th>
                        <th class="px-6 py-5 border-r border-gray-100 uppercase">Username</th>
                        <th class="px-6 py-5 border-r border-gray-100">NIK</th>
                        <th class="px-6 py-5 border-r border-gray-100 uppercase">No. Telepon</th>
                        <th class="px-6 py-5 border-r border-gray-100">Email</th>
                        <th class="px-6 py-5 border-r border-gray-100 text-center">RT</th>
                        <th class="px-6 py-5 text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($warga as $index => $w)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-black border-r border-gray-100">{{ $w->name }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $w->username }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $w->nik ?? '-' }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $w->phone ?? '-' }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $w->email }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $w->rt }}</td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('rt.warga.show', $w->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Belum ada warga terdaftar di RT {{ $userRt }}.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
