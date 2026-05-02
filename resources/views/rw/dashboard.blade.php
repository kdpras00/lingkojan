@extends('layouts.rw')

@section('title', 'Dashboard Ketua RW')
@section('page_title', 'Dashboard Ketua RW 006')

@section('content')
<div class="space-y-8">
    <!-- Statistics Cards -->
    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <div class="card !p-6 border-b-4 border-blue-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total RW</h4>
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
        <div class="card !p-6 border-b-4 border-red-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Cancel</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['cancel'] }}</div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="card !p-10 space-y-10">
        <div class="border-b border-gray-100 pb-6">
            <h3 class="text-2xl font-bold text-black tracking-tight">Pengaduan Warga Terbaru</h3>
            <p class="text-sm text-gray-500 font-medium mt-1">Daftar laporan yang masuk dari seluruh warga di wilayah RW 006</p>
        </div>

        <!-- Filter Section -->
        <form action="{{ route('rw.dashboard') }}" method="GET" class="bg-gray-50/50 rounded-3xl border border-gray-100 p-8">
            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-6">Filter Laporan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Status</label>
                    <select name="status" class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat">
                        <option value="">Semua Status</option>
                        <option value="New" {{ request('status') == 'New' ? 'selected' : '' }}>New</option>
                        <option value="On Progress" {{ request('status') == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                        <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="Cancel" {{ request('status') == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">RT</label>
                    <select name="rt" class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat">
                        <option value="">Semua RT</option>
                        <option value="001" {{ request('rt') == '001' ? 'selected' : '' }}>RT 001</option>
                        <option value="002" {{ request('rt') == '002' ? 'selected' : '' }}>RT 002</option>
                        <option value="003" {{ request('rt') == '003' ? 'selected' : '' }}>RT 003</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                    <select name="kategori" class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500/20 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat">
                        <option value="">Semua Kategori</option>
                        <option value="Kebersihan" {{ request('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="Keamanan" {{ request('kategori') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
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
                    <button type="submit" class="w-full bg-black text-white px-4 py-3.5 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm h-[46px]">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- Data Table Section -->
        <div class="space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h4 class="text-xl font-bold text-black tracking-tight">Data Pengaduan</h4>
                
                <form action="{{ route('rw.dashboard') }}" method="GET" class="relative w-full md:w-80 group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#f07c1b] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nomor pengaduan..." class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm bg-white placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all shadow-sm">
                </form>
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
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">RT</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Subject</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Last Status</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPengaduans as $index => $pengaduan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100">{{ $pengaduan->nomor_pengaduan }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $pengaduan->kategori }}</td>
                            <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $pengaduan->rt }}</td>
                            <td class="px-6 py-5 text-sm font-medium text-gray-700 border-r border-gray-100">{{ $pengaduan->subjek }}</td>
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
                            <td colspan="9" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Belum ada pengaduan.</td>
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
        const filterForm = document.querySelector('form[action="{{ route('rw.dashboard') }}"]');
        const tableBody = document.querySelector('tbody');
        const searchForm = searchInput.closest('form');

        // Realtime Search (Client-side)
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
                        <td colspan="9" class="px-6 py-10 text-center text-sm font-bold text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                `);
            }
        });

        // AJAX Filtering
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData);
            
            tableBody.style.opacity = '0.5';
            
            fetch(`{{ route('rw.dashboard') }}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTableBody = doc.querySelector('tbody');
                tableBody.innerHTML = newTableBody.innerHTML;
                tableBody.style.opacity = '1';
                
                const newStats = doc.querySelector('.grid.grid-cols-2');
                if (newStats) {
                    document.querySelector('.grid.grid-cols-2').innerHTML = newStats.innerHTML;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                tableBody.style.opacity = '1';
            });
        });

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    });
</script>
@endpush
@endsection
