@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard Petugas')

@section('content')
<div class="space-y-8">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="card !p-6 border-b-4 border-blue-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Laporan</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['total'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-orange-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">New</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['new'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">On Progress</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['progress'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-green-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Done</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['done'] }}</div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="card !p-10 space-y-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-bold text-black tracking-tight">Tugas Pengaduan Aktif</h3>
            <p class="text-sm text-gray-500 font-medium mt-1">Daftar laporan pengaduan yang perlu segera ditindaklanjuti</p>
        </div>

        <!-- Data Table Section -->
        <div class="space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h4 class="text-xl font-bold text-black tracking-tight">Daftar Tugas</h4>
                
                <div class="relative w-full md:w-80 group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#f07c1b] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" placeholder="Cari nomor atau subjek..." class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm bg-white placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all shadow-sm">
                </div>
            </div>

            <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Tanggal</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nomor Pengaduan</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nama Warga</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Subject</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPengaduans as $index => $pengaduan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100">{{ $pengaduan->nomor_pengaduan }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->details->first()->user->nama_warga ?? '-' }}</td>
                            <td class="px-6 py-5 text-sm font-medium text-gray-600 border-r border-gray-100">{{ $pengaduan->subject }}</td>
                            <td class="px-6 py-5 border-r border-gray-100">
                                @php
                                    $lastDetail = $pengaduan->details->last();
                                    $statusName = $lastDetail->status->status ?? 'Unknown';
                                    $statusId = $lastDetail->pengaduan_status_id ?? 0;
                                    
                                    $statusColors = [
                                        10 => 'text-blue-600',
                                        20 => 'text-orange-600',
                                        30 => 'text-green-600',
                                        40 => 'text-red-600',
                                    ];
                                    $textColor = $statusColors[$statusId] ?? 'text-gray-600';
                                @endphp
                                <span class="{{ $textColor }} text-[10px] font-bold uppercase tracking-widest">
                                    {{ $statusName }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href="{{ route('petugas.pengaduan.show', $pengaduan->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                                    <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Tidak ada tugas aktif.</td>
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
        const searchInput = document.querySelector('input[name="q"]');
        const tableBody = document.querySelector('tbody');
        const rows = tableBody.querySelectorAll('tr');
        const emptyRowTemplate = `
            <tr id="empty-search-row">
                <td colspan="8" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Data tidak ditemukan.</td>
            </tr>
        `;

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
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
                tableBody.insertAdjacentHTML('beforeend', emptyRowTemplate);
            }
        });
    });
</script>
@endpush
@endsection
