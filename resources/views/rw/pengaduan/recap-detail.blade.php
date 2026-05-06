@extends('layouts.rw')

@section('title', 'Rekap Laporan RW Detail')
@section('page_title', 'Laporan Rekap')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb (Optional, but good for UX) -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rw.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <a href="{{ route('rw.pengaduan.recap') }}" class="hover:text-[#f07c1b]">Laporan Rekap</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Detail Rekap</span>
    </div>

    <div class="card !p-10 space-y-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-bold text-black tracking-tight">Laporan Rekap</h3>
            <p class="text-sm text-gray-500 font-medium mt-1">Ringkasan laporan pengaduan warga di wilayah RW 006</p>
        </div>

        <div class="border border-gray-100 rounded-3xl p-8 space-y-8">
            <div class="border-b border-gray-100 pb-6">
                <h4 class="text-xl font-bold text-black tracking-tight">Pengaduan Warga Terbaru</h4>
                <p class="text-sm text-gray-500 font-medium mt-1">Daftar laporan yang masuk dari warga di wilayah RW 006</p>
            </div>

            <!-- Filter Section -->
            <form action="{{ route('rw.pengaduan.recap.detail') }}" method="GET" class="bg-gray-50/50 rounded-2xl border border-gray-100 p-6">
                <!-- Keep existing query parameters that shouldn't change -->
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif

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

            <!-- Table section -->
            <div class="overflow-x-auto border border-gray-100 rounded-2xl shadow-sm bg-white">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Tanggal Pengaduan</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nomor Pengaduan</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Pelapor</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Kategori</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100 text-center">RT</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Subject</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                            <th class="px-4 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pengaduans as $index => $pengaduan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-4 text-xs font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 text-xs font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->created_at->format('d-m-Y H.i') }}</td>
                            <td class="px-4 py-4 text-xs font-bold text-black border-r border-gray-100">{{ $pengaduan->nomor_pengaduan }}</td>
                            <td class="px-4 py-4 text-xs font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->user->name ?? '-' }}</td>
                            <td class="px-4 py-4 text-xs font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->kategori }}</td>
                            <td class="px-4 py-4 text-xs font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $pengaduan->rt }}</td>
                            <td class="px-4 py-4 text-xs font-medium text-gray-600 border-r border-gray-100">{{ $pengaduan->subjek }}</td>
                            <td class="px-4 py-4 border-r border-gray-100">
                                @php
                                    $statusColors = [
                                        'New' => 'text-blue-600',
                                        'On Progress' => 'text-orange-600',
                                        'Done' => 'text-green-600',
                                        'Cancel' => 'text-red-600',
                                    ];
                                    $textColor = $statusColors[$pengaduan->status] ?? 'text-gray-600';
                                @endphp
                                <span class="{{ $textColor }} text-[10px] font-bold uppercase tracking-widest">
                                    {{ $pengaduan->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('rw.pengaduan.show', $pengaduan->id) }}" class="text-[10px] font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-10 text-center text-sm font-normal text-gray-400">Data tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
