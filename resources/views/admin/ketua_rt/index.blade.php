@extends('layouts.admin')

@section('title', 'Kelola Data Ketua RT')
@section('page_title', 'Kelola Data Ketua RT')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Data Ketua RT</span>
    </div>

    <div class="card !p-10 space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-gray-100 pb-8">
            <div>
                <h3 class="text-2xl font-black text-black tracking-tight">Daftar Ketua RT</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola data pejabat Ketua Rukun Tetangga (RT)</p>
            </div>
            <a href="{{ route('admin.ketua_rt.create') }}" class="bg-black text-white px-8 py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-lg flex items-center group">
                <svg class="w-4 h-4 mr-2 transform group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah
            </a>
        </div>

        <div class="overflow-x-auto border border-gray-100 rounded-3xl shadow-sm bg-white">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center border-r border-gray-100 w-24">No</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100 w-24">RT</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Username</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-r border-gray-100">Nama</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Menu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ketuaRts as $index => $ketua)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-5 text-sm font-medium text-gray-500 text-center border-r border-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-5 text-sm font-bold text-black border-r border-gray-100 text-center">{{ $ketua->rt ?: '-' }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-gray-700 border-r border-gray-100">{{ $ketua->username }}</td>
                        <td class="px-6 py-5 text-sm font-semibold text-black border-r border-gray-100">{{ $ketua->name }}</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.ketua_rt.edit', $ketua->id) }}" class="p-1 text-gray-400 hover:text-orange-600 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ $ketua->name }}', {{ $ketua->id }})" class="p-1 text-gray-400 hover:text-red-600 transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm font-normal text-gray-400">Belum ada data Ketua RT.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal (Wireframe 40) -->
<div id="delete_modal" class="fixed inset-0 z-[2000] hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-sm">
        <div class="bg-white rounded-[32px] overflow-hidden shadow-2xl border border-gray-100">
            <div class="p-10 text-center space-y-6">
                <div>
                    <h4 class="text-xl font-black text-black tracking-tight" id="modal_title">Hapus Nahrawi</h4>
                    <p class="text-sm text-gray-500 font-medium mt-3 leading-relaxed" id="modal_body">Apakah anda yakin ingin menghapus Nahrawi?</p>
                </div>
                <div class="grid grid-cols-2 gap-0 border-t border-gray-100 -mx-10 -mb-10">
                    <form id="delete_form" action="" method="POST" class="w-full border-r border-gray-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-5 text-sm font-black text-black hover:bg-red-50 hover:text-red-600 transition-colors uppercase tracking-widest">Yes</button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="py-5 text-sm font-black text-black hover:bg-gray-50 transition-colors uppercase tracking-widest">No</button>
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
        document.getElementById('delete_form').action = '/admin/ketua_rt/' + id;
        document.getElementById('delete_modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('delete_modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush
@endsection
