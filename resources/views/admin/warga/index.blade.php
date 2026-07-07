@extends('layouts.admin')

@section('title', 'Kelola Data Warga')
@section('page_title', 'Kelola Data Warga')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Kelola Data Warga</span>
    </div>

    <!-- Filter Section (Wireframe 41) -->
    <div class="card !p-8 shadow-sm">
        <form action="{{ route('admin.warga.index') }}" method="GET" class="space-y-6">
            <div class="flex items-center">
                <h4 class="text-sm font-bold text-black uppercase tracking-widest">Filter Warga</h4>
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end gap-6">
                <div class="flex-1 max-w-xs">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">RT</label>
                    <select name="rt_id" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat">
                        <option value="">Semua RT</option>
                        @foreach($availableRts as $art)
                            <option value="{{ $art->id }}" {{ request('rt_id') == $art->id ? 'selected' : '' }}>{{ $art->nama_rt }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-white border-2 border-black text-black px-8 py-3.5 rounded-none text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">Terapkan Filter</button>
            </div>
        </form>
    </div>

    <div class="card !p-10 space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-gray-100 pb-8">
            <div>
                <h3 class="text-2xl font-bold text-black tracking-tight">Daftar Warga</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola data masyarakat LingKojan</p>
            </div>
            <a href="{{ route('admin.warga.create') }}" class="bg-white border-2 border-black text-black px-8 py-3 rounded-none text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] flex items-center group">
                <svg class="w-4 h-4 mr-2 transform group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah User
            </a>
        </div>

        <!-- Search Box -->
        <div class="max-w-md">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" id="search-input" placeholder="Cari berdasarkan nama, username, NIK, RT, status..." class="w-full bg-gray-50 border border-gray-200 rounded-2xl pl-12 pr-6 py-3.5 text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all">
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-16">No</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nama</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Username</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">NIK</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">No. Telepon</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Email</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">RT</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100 text-center w-28">Status</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($wargas as $index => $warga)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-black border-r border-gray-100">{{ $warga->nama_warga }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $warga->username }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-600 border-r border-gray-100 tracking-wider">{{ $warga->nik }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $warga->no_tlp }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $warga->email }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100 text-center">{{ $warga->rt->nama_rt ?? '-' }}</td>
                        <td class="px-6 py-5 border-r border-gray-100 text-center">
                            @if($warga->is_approved)
                                <span class="px-3 py-1.5 text-[11px] font-black uppercase tracking-wider text-green-700 bg-green-50 border border-green-200 rounded-md">Disetujui</span>
                            @else
                                <span class="px-3 py-1.5 text-[11px] font-black uppercase tracking-wider text-amber-700 bg-amber-50 border border-amber-200 rounded-md">Menunggu</span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center space-x-2">
                                @if(!$warga->is_approved)
                                    <form action="{{ route('admin.warga.approve', $warga->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1 text-gray-400 hover:text-green-600 transition-colors" title="Setujui">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>
                                    <button type="button" onclick="openRejectModal('{{ $warga->nama_warga }}', {{ $warga->id }})" class="p-1 text-gray-400 hover:text-red-500 transition-colors" title="Tolak">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                @endif
                                <a href="{{ route('admin.warga.show', $warga->id) }}" class="p-1 text-gray-400 hover:text-blue-600 transition-colors" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="{{ route('admin.warga.edit', $warga->id) }}" class="p-1 text-gray-400 hover:text-orange-600 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ $warga->nama_warga }}', {{ $warga->id }})" class="p-1 text-gray-400 hover:text-red-600 transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Belum ada data warga.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete_modal" class="fixed inset-0 z-[2000] hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm">
        <div class="bg-white rounded-[32px] overflow-hidden shadow-2xl border border-gray-100">
            <div class="p-10 text-center space-y-6">
                <div>
                    <h4 class="text-xl font-bold text-black tracking-tight" id="modal_title">Hapus User</h4>
                    <p class="text-sm text-gray-500 font-medium mt-3 leading-relaxed" id="modal_body">Apakah anda yakin ingin menghapus user ini?</p>
                </div>
                <div class="grid grid-cols-2 gap-0 border-t border-gray-100 -mx-10 -mb-10">
                    <form id="delete_form" action="" method="POST" class="w-full border-r border-gray-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-5 text-sm font-bold text-black hover:bg-red-50 hover:text-red-600 transition-colors uppercase tracking-widest">Yes</button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="py-5 text-sm font-bold text-black hover:bg-gray-50 transition-colors uppercase tracking-widest">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Confirmation Modal -->
<div id="reject_modal" class="fixed inset-0 z-[2000] hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm">
        <div class="bg-white rounded-[32px] overflow-hidden shadow-2xl border border-gray-100">
            <div class="p-10 text-center space-y-6">
                <div>
                    <h4 class="text-xl font-bold text-black tracking-tight" id="reject_modal_title">Tolak Pendaftaran</h4>
                    <p class="text-sm text-gray-500 font-medium mt-3 leading-relaxed" id="reject_modal_body">Apakah anda yakin ingin menolak pendaftaran warga ini?</p>
                </div>
                <div class="grid grid-cols-2 gap-0 border-t border-gray-100 -mx-10 -mb-10">
                    <form id="reject_form" action="" method="POST" class="w-full border-r border-gray-100">
                        @csrf
                        <button type="submit" class="w-full py-5 text-sm font-bold text-black hover:bg-red-50 hover:text-red-600 transition-colors uppercase tracking-widest">Yes</button>
                    </form>
                    <button type="button" onclick="closeRejectModal()" class="py-5 text-sm font-bold text-black hover:bg-gray-50 transition-colors uppercase tracking-widest">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openDeleteModal(name, id) {
        document.getElementById('modal_title').innerText = 'Hapus ' + name;
        document.getElementById('modal_body').innerText = 'Apakah anda yakin ingin menghapus ' + name + '? Data yang dihapus tidak dapat dikembalikan.';
        document.getElementById('delete_form').action = '/admin/warga/' + id;
        document.getElementById('delete_modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('delete_modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openRejectModal(name, id) {
        document.getElementById('reject_modal_title').innerText = 'Tolak ' + name;
        document.getElementById('reject_modal_body').innerText = 'Apakah anda yakin ingin menolak pendaftaran ' + name + '? Akun ini akan dihapus dari sistem.';
        document.getElementById('reject_form').action = '/admin/warga/' + id + '/reject';
        document.getElementById('reject_modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        document.getElementById('reject_modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Realtime Search Logic
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('tbody tr');
        let hasVisibleRows = false;

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return;

            const name = row.cells[1].textContent.toLowerCase();
            const username = row.cells[2].textContent.toLowerCase();
            const nik = row.cells[3].textContent.toLowerCase();
            const phone = row.cells[4].textContent.toLowerCase();
            const email = row.cells[5].textContent.toLowerCase();
            const rt = row.cells[6].textContent.toLowerCase();
            const status = row.cells[7].textContent.toLowerCase();

            const matches = name.includes(query) || 
                            username.includes(query) || 
                            nik.includes(query) || 
                            phone.includes(query) || 
                            email.includes(query) || 
                            rt.includes(query) ||
                            status.includes(query);

            if (matches) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Toggle "no results" placeholder
        let noResultsRow = document.getElementById('no-results-row');
        if (!hasVisibleRows && query !== '') {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'no-results-row';
                noResultsRow.innerHTML = `<td colspan="9" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Tidak ada warga yang cocok dengan pencarian "${this.value}".</td>`;
                document.querySelector('tbody').appendChild(noResultsRow);
            }
        } else {
            if (noResultsRow) {
                noResultsRow.remove();
            }
        }
    });
</script>
@endpush
@endsection
