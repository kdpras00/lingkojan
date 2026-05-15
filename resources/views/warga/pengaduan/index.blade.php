@extends('layouts.warga')

@section('title', 'Pengaduan Saya')
@section('page_title', 'Pengaduan Saya')

@section('content')
<div class="card">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h4 class="font-black text-2xl text-black tracking-tight">Pengaduan Saya</h4>
            <p class="text-sm text-gray-500 font-medium mt-1">Daftar laporan pengaduan yang telah Anda kirimkan</p>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
            <div class="relative w-full md:w-64 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400 group-focus-within:text-[#f07c1b] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="warga-search" placeholder="Cari laporan..." class="block w-full pl-11 pr-4 py-3 border border-gray-100 rounded-2xl text-xs font-bold bg-gray-50/50 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-3xl border border-gray-100 shadow-sm bg-white">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/80 border-b border-gray-100">
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest border-r border-gray-100 w-16 text-center">No</th>
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest border-r border-gray-100">Tanggal</th>
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest border-r border-gray-100">Nomor Pengaduan</th>
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest border-r border-gray-100">Nama Warga</th>
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest border-r border-gray-100">Subject</th>
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                    <th class="px-6 py-5 font-black text-[10px] text-gray-400 uppercase tracking-widest text-center">Menu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pengaduans as $index => $pengaduan)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="px-6 py-5 text-sm font-bold text-gray-500 border-r border-gray-100 text-center">{{ $index + 1 }}</td>
                    @php
                        $latestDetail = $pengaduan->details->last();
                        $statusName = $latestDetail->status->status ?? 'New';
                    @endphp
                    <td class="px-6 py-5 text-sm font-bold text-gray-700 border-r border-gray-100">{{ \Carbon\Carbon::parse($latestDetail->tgl)->format('d F Y H:i') }}</td>
                    <td class="px-6 py-5 text-sm font-black text-black border-r border-gray-100 tracking-wider">{{ $pengaduan->nomor_pengaduan }}</td>
                    <td class="px-6 py-5 text-sm font-bold text-gray-700 border-r border-gray-100">{{ auth()->user()->nama_warga }}</td>
                    <td class="px-6 py-5 text-sm font-bold text-gray-700 border-r border-gray-100">{{ $pengaduan->subject }}</td>
                    <td class="px-6 py-5 border-r border-gray-100">
                        <span class="text-black text-[10px] font-black uppercase tracking-widest">
                            {{ $statusName }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('warga.pengaduan.show', $pengaduan->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                            <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Belum ada pengaduan yang dibuat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('warga-search');
        const tableBody = document.querySelector('tbody');
        const rows = tableBody.querySelectorAll('tr');
        const emptyRowTemplate = `
            <tr id="empty-search-row">
                <td colspan="7" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Data tidak ditemukan.</td>
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
