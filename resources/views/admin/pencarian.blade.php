@extends('layouts.admin')

@section('title', 'Pencarian Nomor Pengaduan')
@section('page_title', 'Pencarian')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Pencarian Nomor Pengaduan</span>
    </div>

    <div class="card !p-12 space-y-12">
        <div class="border-b border-gray-100 pb-8">
            <h3 class="text-2xl font-black text-black tracking-tight">Pencarian Nomor Pengaduan</h3>
            <p class="text-sm text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Daftar laporan yang masuk dari warga di wilayah RW 006</p>
        </div>

        <!-- Search Form (Wireframe: General - Pencarian Data) -->
        <form action="{{ route('admin.pencarian') }}" method="GET" class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-10 bg-gray-50/50 p-8 rounded-3xl border border-gray-100/50">
            <label class="text-sm font-black text-black uppercase tracking-widest min-w-[200px]">Nomor Pengaduan</label>
            <div class="flex-1 max-w-md relative group">
                <input type="text" name="q" value="{{ request('q') }}" class="w-full bg-white border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all" placeholder="Masukkan nomor pengaduan atau subjek...">
            </div>
            <button type="submit" class="bg-black text-white px-10 py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl">Cari</button>
        </form>

        <!-- Results Table -->
        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100">Tanggal Pengaduan</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100">Nomor Pengaduan</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100">Pelapor</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100">Kategori</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100 w-20 text-center">RT</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100">Subjek</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($results as $index => $res)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $res->created_at->format('d-m-Y H:i') }}</td>
                        <td<td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100 tracking-wider">{{ $res->nomor_pengaduan }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $res->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 uppercase tracking-tighter">{{ $res->kategori }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $res->rt }}</td>
                        <td class="px-6 py-5 text-sm font-medium text-gray-600 border-r border-gray-100">{{ $res->subjek }}</td>
                        <td class="px-6 py-5 border-r border-gray-100">
                            @php
                                $statusColors = [
                                    'New' => 'text-blue-600',
                                    'On Progress' => 'text-orange-600',
                                    'Done' => 'text-green-600',
                                    'Cancel' => 'text-red-600',
                                ];
                                $textColor = $statusColors[$res->status] ?? 'text-gray-600';
                            @endphp
                            <span class="{{ $textColor }} text-[10px] font-black uppercase tracking-widest">
                                {{ $res->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('admin.pengaduan.show', $res->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-sm font-normal text-gray-400">
                            @if(request('q'))
                                Tidak ditemukan data untuk "{{ request('q') }}"
                            @else
                                Masukkan nomor pengaduan untuk memulai pencarian.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
