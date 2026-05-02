@extends('layouts.warga')

@section('title', 'Detail Pengaduan')
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

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImagePreview();
    });
</script>
@endpush

@section('content')

<!-- Image Preview Modal -->
<div id="imagePreviewModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-2 transition-all duration-300">
    <!-- Backdrop with blur -->
    <div class="absolute inset-0 bg-black/90 backdrop-blur-xl" onclick="closeImagePreview()"></div>
    
    <!-- Modal Content -->
    <div class="relative w-full flex flex-col items-center animate-in fade-in zoom-in duration-300">
        <img id="previewImage" src="" class="max-w-[95vw] max-h-[90vh] object-contain shadow-2xl transition-all">
        
        <!-- Close Button Below -->
        <button onclick="closeImagePreview()" class="mt-8 bg-white/20 hover:bg-red-500 text-white p-5 rounded-full transition-all backdrop-blur-md border border-white/30 shadow-2xl group">
            <svg class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
</div>

<!-- Breadcrumb -->
<div class="mb-10 flex items-center text-sm font-bold text-black px-4 md:px-0">
    <a href="{{ route('warga.dashboard') }}" class="hover:text-[#f07c1b]">Dashboard</a>
    <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
    <a href="{{ route('warga.pengaduan.index') }}" class="hover:text-[#f07c1b]">Pengaduan Saya</a>
    <span class="mx-3 text-gray-300 font-normal text-lg">/</span>
    <span class="text-gray-400">Detail #{{ $pengaduan->nomor_pengaduan }}</span>
</div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Left Column: Details -->
        <div class="lg:col-span-8 space-y-8">
            <div class="card !p-10">
                <!-- Header Rincian -->
                <div class="border-b border-gray-100 pb-5 mb-10 flex items-center justify-between">
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">Pengaduan Header</h3>
                    @if($pengaduan->status == 'New')
                    <form action="{{ route('warga.pengaduan.cancel', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengaduan ini?')">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all shadow-sm">
                            Batalkan Pengaduan
                        </button>
                    </form>
                    @endif
                </div>

                <div class="space-y-16">
                    <!-- Section: Rincian -->
                    <div class="border border-gray-100 rounded-3xl overflow-hidden shadow-sm">
                        <div class="bg-gray-50/50 px-8 py-5 border-b border-gray-100">
                            <h4 class="font-extrabold text-black uppercase text-sm tracking-widest">Rincian</h4>
                        </div>
                        <div class="p-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-10">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Nomor Pengaduan</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->nomor_pengaduan }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Pengaduan</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->created_at->format('d-m-Y H:i') }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->kategori }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->address ?? '-' }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Status Terakhir</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm uppercase">{{ $pengaduan->status }}</div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Warga</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->name }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">NIK</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->nik ?? '-' }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">No. Telepon</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->phone ?? '-' }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Email</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->email }}</div>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">RT</label>
                                        <div class="bg-gray-100 border border-gray-200 rounded-2xl px-5 py-3.5 text-sm font-bold text-gray-600 shadow-sm">{{ $pengaduan->user->rt ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Full Width Subject -->
                            <div class="group mb-8">
                                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Subjek Laporan</label>
                                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 shadow-sm leading-relaxed">
                                    {{ $pengaduan->subjek }}
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Isi Laporan / Alamat Kejadian</label>
                                <div class="bg-gray-100 border border-gray-200 rounded-2xl px-6 py-5 text-sm font-medium text-gray-600 shadow-sm leading-relaxed">
                                    "{{ $pengaduan->alamat ?? 'Tidak ada detail alamat.' }}"
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
                            @forelse($pengaduan->tindakLanjuts as $tindak)
                            <div class="border border-gray-100 rounded-3xl overflow-hidden shadow-sm bg-white hover:border-[#f07c1b]/30 transition-all">
                                <div class="bg-gray-50/50 px-8 py-4 border-b border-gray-100 flex justify-between items-center">
                                    <span class="font-bold text-sm text-black">{{ $tindak->user->name }} <span class="text-xs font-normal text-gray-400 ml-2">({{ $tindak->user->roles->first()->name ?? 'User' }})</span></span>
                                    <div class="flex flex-col items-end space-y-1">
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $tindak->created_at->format('d M Y H:i') }}</span>
                                        <span class="text-[10px] font-black uppercase tracking-widest
                                            {{ $tindak->status == 'New' ? 'text-blue-600' : 
                                              ($tindak->status == 'On Progress' ? 'text-orange-600' : 
                                              ($tindak->status == 'Done' ? 'text-green-600' : 'text-red-600')) }}">
                                            {{ $tindak->status }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-8">
                                    <div class="text-sm text-gray-600 leading-relaxed">
                                        "{{ $tindak->detail }}"
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="bg-gray-50 rounded-3xl p-10 text-center border border-dashed border-gray-200">
                                <p class="text-gray-400 text-sm font-bold">Belum ada tindak lanjut untuk pengaduan ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
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
                        // If cancel, we might want to show it differently, but for now simple linear logic
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

@endsection
