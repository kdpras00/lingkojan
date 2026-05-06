@extends('layouts.rw')

@section('title', 'Kelola Pengaduan')
@section('page_title', 'Kelola Pengaduan')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('rw.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Kelola Pengaduan</span>
    </div>

    <div class="card !p-10 space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-gray-100 pb-8">
            <div>
                <h3 class="text-2xl font-bold text-black tracking-tight">Data Pengaduan</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Pantau dan kelola seluruh pengaduan warga</p>
            </div>
            
            <!-- Search Bar (Wireframe 53) -->
            <div class="flex items-center space-x-3">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400 group-focus-within:text-[#f07c1b] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="admin-search" class="bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-6 py-2.5 text-xs font-bold text-gray-700 focus:outline-none focus:border-[#f07c1b] w-64" placeholder="masukan nomor pengaduan...">
                </div>
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
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Kategori</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Subjek</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengaduans as $index => $pengaduan)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100 tracking-wider">{{ $pengaduan->nomor_pengaduan }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-5 text-[11px] font-bold text-gray-600 border-r border-gray-100 uppercase tracking-wider">{{ $pengaduan->kategori }}</td>
                        <td class="px-6 py-5 text-sm font-medium text-gray-600 border-r border-gray-100">{{ $pengaduan->subjek }}</td>
                        <td class="px-6 py-5 border-r border-gray-100">
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
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('rw.pengaduan.show', $pengaduan->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Belum ada data pengaduan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
                        <td colspan="8" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                `);
            }
        });
    });
</script>
@endpush
@endsection
