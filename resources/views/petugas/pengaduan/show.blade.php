@extends('layouts.petugas')

@section('title', 'Detail Pengaduan Petugas')
@section('page_title', 'Detail Pengaduan')

@push('scripts')
<script>
    function openImagePreview(src) {
        const modal = document.getElementById('imagePreviewModal');
        const img = document.getElementById('previewImage');
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeImagePreview() {
        const modal = document.getElementById('imagePreviewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function showResponseForm() {
        document.getElementById('initial_action').classList.add('hidden');
        document.getElementById('response_form').classList.remove('hidden');
        document.getElementById('response_section').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_upload');
        const preview = document.getElementById('upload_preview');
        const container = document.getElementById('preview_container');
        const label = document.getElementById('file_label');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        container.classList.remove('hidden');
                        label.textContent = 'Ganti Foto';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        window.removeImage = function() {
            fileInput.value = "";
            container.classList.add('hidden');
            label.textContent = 'Pilih Foto Bukti';
            preview.src = "";
        };
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImagePreview();
    });
</script>
@endpush

@section('content')

<!-- Image Preview Modal -->
<div id="imagePreviewModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-2 transition-all duration-300">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-xl" onclick="closeImagePreview()"></div>
    <div class="relative w-full flex flex-col items-center animate-in fade-in zoom-in duration-300">
        <img id="previewImage" src="" class="max-w-[95vw] max-h-[90vh] object-contain shadow-2xl transition-all">
        <button onclick="closeImagePreview()" class="mt-8 bg-white/20 hover:bg-red-500 text-white p-5 rounded-full transition-all backdrop-blur-md border border-white/30 shadow-2xl group">
            <svg class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
</div>

<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
        <a href="{{ route('petugas.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
        <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
        <span class="text-gray-400">Detail #{{ $pengaduan->nomor_pengaduan }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Left Column: Details & Actions -->
        <div class="lg:col-span-8 space-y-8">
            <div class="card !p-10">
                <!-- Header Rincian -->
                <div class="border-b border-gray-100 pb-5 mb-10 flex items-center justify-between">
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">Rincian Pengaduan</h3>
                </div>

                <div class="space-y-16">
                    <!-- Section: Rincian -->
                    <div class="border border-gray-100 rounded-3xl overflow-hidden shadow-sm">
                        <div class="bg-gray-50/50 px-8 py-5 border-b border-gray-100">
                            <h4 class="font-extrabold text-black uppercase text-sm tracking-widest">Informasi Pengaduan</h4>
                        </div>
                        <div class="p-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mb-8">
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nomor Pengaduan</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->nomor_pengaduan }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Warga</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->name }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Tanggal Pengaduan</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->created_at->format('d-m-Y H:i') }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">NIK</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->nik ?? '-' }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->kategori }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">No. Telepon</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->phone ?? '-' }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Lokasi / Alamat</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->alamat ?? '-' }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->email ?? '-' }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Status Terakhir</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm uppercase">{{ $pengaduan->status }}</div>
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">RT</label>
                                    <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm uppercase">{{ $pengaduan->rt }}</div>
                                </div>
                            </div>

                            <!-- Full Width Subject -->
                            <div class="group">
                                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Isi Laporan / Subjek</label>
                                <div class="bg-gray-50 border-2 border-gray-100 rounded-3xl p-8 text-lg font-bold text-black shadow-inner leading-relaxed group-hover:border-[#f07c1b]/20 transition-all">
                                    {{ $pengaduan->subjek }}
                                </div>
                            </div>

                            @if($pengaduan->foto)
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-4">Lampiran Bukti</label>
                                <div class="relative max-w-sm rounded-3xl overflow-hidden shadow-lg group/img cursor-pointer" onclick="openImagePreview('{{ asset('storage/' . $pengaduan->foto) }}')">
                                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Bukti" class="w-full h-auto transition-transform duration-500 group-hover/img:scale-110">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="bg-white text-black px-5 py-2 rounded-xl text-xs font-bold shadow-xl">Lihat Ukuran Penuh</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Section: Riwayat Tindak Lanjut -->
                    <div class="space-y-8">
                        <div class="border-b border-gray-100 pb-5">
                            <h3 class="text-2xl font-black text-black tracking-tight">Riwayat Tindak Lanjut</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Card 1: Data Awal (New) -->
                            <div class="border border-gray-200 rounded-[32px] p-10 space-y-8 bg-white shadow-sm hover:shadow-md transition-all border-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status</label>
                                        <div class="bg-blue-50 border border-blue-100 rounded-2xl px-6 py-3.5 text-sm font-black text-blue-600 shadow-sm">
                                            New
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">User</label>
                                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-black text-gray-700 shadow-sm">
                                            {{ $pengaduan->user->name }}
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pengaduan</label>
                                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-black text-gray-700 shadow-sm">
                                            {{ $pengaduan->created_at->format('d-m-Y H.i') }}
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Role</label>
                                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-black text-gray-700 shadow-sm uppercase">
                                            {{ $pengaduan->user->roles->first()->name ?? 'Warga' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Detail Pengaduan</label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5 text-sm font-bold text-gray-600 shadow-sm leading-relaxed min-h-[80px]">
                                        {{ $pengaduan->subjek }}
                                    </div>
                                </div>
                                @if($pengaduan->foto)
                                <div class="flex items-center text-sm font-black text-gray-700 ml-1">
                                    <span class="mr-2">Download File:</span>
                                    <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank" class="text-blue-500 hover:underline italic">
                                        {{ basename($pengaduan->foto) }}
                                    </a>
                                </div>
                                @endif
                            </div>

                            <!-- Tindak Lanjut Berikutnya -->
                            @foreach($pengaduan->tindakLanjuts->sortBy('created_at') as $tindak)
                            <div class="border border-gray-200 rounded-[32px] p-10 space-y-8 bg-white shadow-sm hover:shadow-md transition-all border-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status</label>
                                        <div class="border rounded-2xl px-6 py-3.5 text-sm font-black shadow-sm
                                            {{ $tindak->status == 'New' ? 'bg-blue-50 border-blue-100 text-blue-600' : 
                                              ($tindak->status == 'On Progress' ? 'bg-orange-50 border-orange-100 text-orange-600' : 
                                              ($tindak->status == 'Done' ? 'bg-green-50 border-green-100 text-green-600' : 'bg-red-50 border-red-100 text-red-600')) }}">
                                            {{ $tindak->status }}
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">User</label>
                                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-black text-gray-700 shadow-sm">
                                            {{ $tindak->user->name }}
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pengaduan</label>
                                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-black text-gray-700 shadow-sm">
                                            {{ $tindak->created_at->format('d-m-Y H.i') }}
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Role</label>
                                        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-black text-gray-700 shadow-sm uppercase">
                                            {{ $tindak->user->roles->first()->name ?? 'User' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Detail Pengaduan</label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5 text-sm font-bold text-gray-600 shadow-sm leading-relaxed min-h-[80px]">
                                        {{ $tindak->detail }}
                                    </div>
                                </div>
                                @if($tindak->foto)
                                <div class="flex items-center text-sm font-black text-gray-700 ml-1">
                                    <span class="mr-2">Download File:</span>
                                    <a href="{{ asset('storage/' . $tindak->foto) }}" target="_blank" class="text-blue-500 hover:underline italic">
                                        {{ basename($tindak->foto) }}
                                    </a>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Section: Beri Tanggapan -->
                    @if(!in_array($pengaduan->status, ['Done', 'Cancel']))
                    <div class="border border-gray-100 rounded-3xl overflow-hidden shadow-sm bg-white" id="response_section">
                        <div class="bg-gray-100 px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                            <h4 class="font-extrabold text-black uppercase text-sm tracking-widest">Beri Tanggapan</h4>
                        </div>
                        <div class="p-10">
                            @if(session('success'))
                            <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl text-sm font-bold mb-8">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Initial Button (Mockup 02) -->
                            <div id="initial_action">
                                <button type="button" onclick="showResponseForm()" class="bg-white border-2 border-gray-200 text-black px-10 py-4 rounded-full text-[11px] font-black uppercase tracking-widest hover:border-[#f07c1b] hover:text-[#f07c1b] transition-all shadow-sm flex items-center group/btn">
                                    Respon Sekarang
                                </button>
                            </div>

                            <!-- Expanded Form (Mockup 03) -->
                            <form id="response_form" action="{{ route('petugas.pengaduan.storeTindakLanjut', $pengaduan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 hidden">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Update Status</label>
                                        <select name="status" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-700 focus:outline-none focus:ring-0 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat">
                                            @if($pengaduan->status == 'New')
                                                <option value="On Progress">On Progress (Lagi diproses)</option>
                                                <option value="Cancel">Cancel (Dibatalkan)</option>
                                            @elseif($pengaduan->status == 'On Progress')
                                                <option value="On Progress" selected>On Progress (Tetap di kondisi ini / Update lanjutan)</option>
                                                <option value="Done">Done (Sudah selesai)</option>
                                                <option value="Cancel">Cancel (Dibatalkan)</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Upload Bukti (Opsional)</label>
                                        <div class="flex flex-col items-center gap-4">
                                            <div id="preview_container" class="hidden relative w-full max-w-sm rounded-2xl overflow-hidden border border-gray-200 shadow-lg flex-shrink-0">
                                                <img id="upload_preview" src="" class="w-full h-auto cursor-pointer" onclick="openImagePreview(this.src)">
                                                <button type="button" onclick="removeImage()" class="absolute top-3 right-3 bg-red-500 text-white p-2 rounded-full shadow-lg hover:bg-red-600 transition-colors z-10">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                            <div class="w-full">
                                                <input type="file" name="foto" class="hidden" id="file_upload">
                                                <label for="file_upload" class="flex items-center justify-center w-full bg-gray-50 border border-dashed border-gray-300 rounded-full px-5 py-3.5 text-[10px] font-black uppercase tracking-widest text-gray-500 cursor-pointer hover:bg-gray-100 transition-all border-2">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"></path></svg>
                                                    <span id="file_label">Pilih Foto Bukti</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="group">
                                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Detail Tanggapan / Hasil Perbaikan</label>
                                    <textarea name="detail" required placeholder="Tuliskan rincian tindakan yang telah dilakukan..." class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-medium text-gray-700 min-h-[150px] focus:outline-none focus:ring-2 focus:ring-[#f07c1b]/20"></textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="bg-black text-white px-10 py-4 rounded-full text-[11px] font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-lg flex items-center group/btn">
                                        Kirim Tanggapan
                                        <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Timeline -->
        <div class="lg:col-span-4">
            <div class="sticky top-32">
                <div class="card !p-10 shadow-xl border border-gray-100">
                    <h4 class="font-black text-xl text-black mb-10 border-b border-gray-50 pb-6 tracking-tight">Status Timeline</h4>
                    
                    <div class="relative pl-16 space-y-12">
                        <!-- Timeline Line -->
                        <div class="absolute left-[29px] top-2 bottom-2 w-0.5 bg-gray-100"></div>

                        @php
                            $steps = [
                                ['label' => 'New', 'id' => 1],
                                ['label' => 'On Progress', 'id' => 2],
                                ['label' => 'Done', 'id' => 3],
                                ['label' => 'Cancel', 'id' => 4],
                            ];
                            
                            $currentStatusIndex = array_search($pengaduan->status, array_column($steps, 'label'));
                        @endphp

                        @foreach($steps as $index => $step)
                            @php
                                $isCompleted = $currentStatusIndex > $index && $pengaduan->status != 'Cancel';
                                $isCurrent = $pengaduan->status == $step['label'];
                                $isCancelStep = $step['label'] == 'Cancel' && $pengaduan->status == 'Cancel';
                                
                                // Reset colors
                                $bgClass = 'bg-white';
                                $borderClass = 'border-gray-200';
                                $textClass = 'text-gray-400';
                                
                                if ($isCompleted || $isCurrent || $isCancelStep) {
                                    if ($step['label'] == 'New') {
                                        $bgClass = 'bg-blue-500';
                                        $borderClass = 'border-blue-500';
                                        $textClass = 'text-blue-600';
                                    } elseif ($step['label'] == 'On Progress') {
                                        $bgClass = 'bg-orange-500';
                                        $borderClass = 'border-orange-500';
                                        $textClass = 'text-orange-600';
                                    } elseif ($step['label'] == 'Done') {
                                        $bgClass = 'bg-green-500';
                                        $borderClass = 'border-green-500';
                                        $textClass = 'text-green-600';
                                    } elseif ($step['label'] == 'Cancel') {
                                        $bgClass = 'bg-red-500';
                                        $borderClass = 'border-red-500';
                                        $textClass = 'text-red-600';
                                    }
                                }
                                
                                $tindakAt = $pengaduan->tindakLanjuts->where('status', $step['label'])->first();
                                
                                // Only pulse for non-terminal current status
                                $shouldPulse = $isCurrent && in_array($step['label'], ['New', 'On Progress']);
                            @endphp

                            @if($step['label'] != 'Cancel' || $pengaduan->status == 'Cancel')
                            <div class="relative">
                                <div class="absolute -left-[45px] top-1 w-5 h-5 flex items-center justify-center z-10">
                                    @if($shouldPulse)
                                        <div class="absolute w-full h-full rounded-full {{ $bgClass }} animate-ping opacity-40"></div>
                                    @endif
                                    <div class="relative w-5 h-5 {{ $bgClass }} border-2 {{ $borderClass }} rounded-full flex items-center justify-center shadow-sm">
                                        @if($isCurrent && in_array($step['label'], ['New', 'On Progress']))
                                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                                        @elseif($isCompleted || ($isCurrent && $step['label'] == 'Done'))
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        @elseif($isCancelStep)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h6 class="font-bold text-md {{ $textClass }} tracking-tight">{{ $index + 1 }}. {{ $step['label'] }}</h6>
                                    <p class="text-[11px] {{ $textClass }} opacity-70 mt-1 font-medium">
                                        {{ $tindakAt ? $tindakAt->created_at->format('d M Y H:i') : ($isCompleted && $step['label'] == 'New' ? $pengaduan->created_at->format('d M Y H:i') : '-') }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
