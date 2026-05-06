@extends('layouts.rw')

@section('title', 'Rekap Laporan RW')
@section('page_title', 'Laporan Rekap')

@section('content')
<div class="space-y-8">
    <div class="card !p-10 space-y-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-bold text-black tracking-tight">Laporan Rekap</h3>
            <p class="text-sm text-gray-500 font-medium mt-1">Ringkasan laporan pengaduan warga di wilayah RW 006</p>
        </div>

        <!-- Filter Section -->
        <form action="{{ route('rw.pengaduan.recap') }}" method="GET" class="bg-gray-50/50 rounded-3xl border border-gray-100 p-8">
            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-6">Filter Laporan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">RT</label>
                    <select name="rt" class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat">
                        <option value="">Semua RT</option>
                        @foreach($availableRts as $art)
                            <option value="{{ $art }}" {{ request('rt') == $art ? 'selected' : '' }}>{{ $art }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Tanggal Awal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-black text-white px-4 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm h-[46px]">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- Summary Table -->
        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">RT</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Kategori</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Total</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recap as $index => $r)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $r->rt }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $r->kategori }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">
                            <span class="text-[10px] font-bold uppercase tracking-widest
                                {{ $r->status == 'New' ? 'text-blue-600' : 
                                  ($r->status == 'On Progress' ? 'text-orange-600' : 
                                  ($r->status == 'Done' ? 'text-green-600' : 'text-red-600')) }}">
                                {{ $r->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100">{{ $r->total }}</td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('rw.pengaduan.recap.detail', ['rt' => $r->rt, 'kategori' => $r->kategori, 'status' => $r->status]) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors inline-block" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
