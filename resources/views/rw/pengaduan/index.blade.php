@extends('layouts.rw')

@section('title', 'Kelola Pengaduan')

@section('content')
<div class="space-y-8">
    <!-- Header Section (Matching Wireframe) -->
    <div class="card !p-10 border border-gray-100 shadow-sm">
        <h3 class="text-2xl font-bold text-black tracking-tight">Dasboard Ketua RW 006</h3>
        <p class="text-sm text-gray-500 font-medium mt-1">Ringkasan laporan pengaduan warga di wilayah RW 006</p>
    </div>

    <div class="card !p-10 space-y-10 border border-gray-100 shadow-sm">
        <!-- Section: Pengaduan Warga Terbaru -->
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-bold text-black tracking-tight">Pengaduan Warga Terbaru</h3>
            <p class="text-sm text-gray-500 font-medium mt-1">Daftar laporan yang masuk dari warga di wilayah RW 006</p>
        </div>

        <!-- Filter Section (Matching Wireframe) -->
        <div class="bg-gray-50/50 rounded-3xl border border-gray-100 p-8 space-y-8">
            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Filter Laporan</h4>
            <form action="{{ route('rw.pengaduan.index') }}" method="GET" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 ml-1">Status</label>
                        <select name="status" class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat">
                            <option value="">Semua Status</option>
                            <option value="10" {{ request('status') == '10' ? 'selected' : '' }}>New</option>
                            <option value="20" {{ request('status') == '20' ? 'selected' : '' }}>On Progress</option>
                            <option value="30" {{ request('status') == '30' ? 'selected' : '' }}>Done</option>
                            <option value="40" {{ request('status') == '40' ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 ml-1">RT</label>
                        <select name="rt_id" class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat">
                            <option value="">Semua RT</option>
                            @foreach($availableRts as $art)
                                <option value="{{ $art->id }}" {{ request('rt_id') == $art->id ? 'selected' : '' }}>RT {{ $art->nama_rt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 ml-1">Kategori</label>
                        <select name="kategori_id" class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat">
                            <option value="">Semua Kategori</option>
                            @foreach($availableKategoris as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 ml-1">Tanggal Awal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 ml-1">Tanggal Akhir</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-white border-2 border-black text-black px-10 py-4 rounded-none text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] h-[54px]">
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Data Pengaduan Section -->
        <div class="space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <h3 class="text-xl font-bold text-black tracking-tight">Data Pengaduan</h3>
                
                <div class="flex items-center space-x-4">
                    <form action="{{ route('rw.pengaduan.index') }}" method="GET" class="flex items-center space-x-2">
                        <!-- Preserve other filters when searching -->
                        @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                        @if(request('rt_id')) <input type="hidden" name="rt_id" value="{{ request('rt_id') }}"> @endif
                        @if(request('kategori_id')) <input type="hidden" name="kategori_id" value="{{ request('kategori_id') }}"> @endif
                        @if(request('start_date')) <input type="hidden" name="start_date" value="{{ request('start_date') }}"> @endif
                        @if(request('end_date')) <input type="hidden" name="end_date" value="{{ request('end_date') }}"> @endif

                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="q" id="admin-search" value="{{ request('q') }}" class="bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-6 py-3 text-xs font-bold text-gray-700 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/5 transition-all w-64" placeholder="cari nomor pengaduan anda...">
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Tanggal Pengaduan</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nomor Pengaduan</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Pelapor</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Kategori</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100 text-center">RT</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Subject</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pengaduans as $index => $pengaduan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100 tracking-wider">{{ $pengaduan->nomor_pengaduan }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->details->first()->user->nama_warga ?? 'N/A' }}</td>
                            <td class="px-6 py-5 text-[11px] font-bold text-gray-600 border-r border-gray-100 uppercase tracking-wider">{{ $pengaduan->kategori->kategori ?? '-' }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $pengaduan->details->first()->user->rt->nama_rt ?? '-' }}</td>
                            <td class="px-6 py-5 text-sm font-medium text-gray-600 border-r border-gray-100">{{ $pengaduan->subject }}</td>
                            <td class="px-6 py-5 border-r border-gray-100">
                                <span class="text-black text-[10px] font-bold uppercase tracking-widest">
                                    {{ $pengaduan->details->first()->status->status ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href="{{ route('rw.pengaduan.show', $pengaduan->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                                    <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Belum ada data pengaduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('admin-search');
        const tableBody = document.querySelector('tbody');

        // Realtime Search (Client-side for instant feel)
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = tableBody.querySelectorAll('tr:not(#empty-search-row)');
            let hasVisibleRow = false;

            const existingEmptyRow = document.getElementById('empty-search-row');
            if (existingEmptyRow) existingEmptyRow.remove();

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    hasVisibleRow = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (!hasVisibleRow && searchTerm !== '') {
                tableBody.insertAdjacentHTML('beforeend', `
                    <tr id="empty-search-row">
                        <td colspan="9" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                `);
            }
        });
    });
</script>
@endpush
@endsection
