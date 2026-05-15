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
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeImagePreview();
        });
        function confirmCancel() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pengaduan ini akan dibatalkan dan tidak dapat diubah kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Tutup',
                borderRadius: '24px'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel-form').submit();
                }
            })
        }
    </script>
@endpush

@section('content')

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal"
        class="fixed inset-0 z-[9999] hidden items-center justify-center p-2 transition-all duration-300">
        <!-- Backdrop with blur -->
        <div class="absolute inset-0 bg-black/90 backdrop-blur-xl" onclick="closeImagePreview()"></div>

        <!-- Modal Content -->
        <div class="relative w-full flex flex-col items-center animate-in fade-in zoom-in duration-300">
            <img id="previewImage" src="" class="max-w-[95vw] max-h-[90vh] object-contain shadow-2xl transition-all">

            <!-- Close Button Below -->
            <button onclick="closeImagePreview()"
                class="mt-8 bg-white/20 hover:bg-red-500 text-white p-5 rounded-full transition-all backdrop-blur-md border border-white/30 shadow-2xl group">
                <svg class="w-8 h-8 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
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
                    @if($pengaduan->details->last()->pengaduan_status_id == 10)
                        <form id="cancel-form" action="{{ route('warga.pengaduan.cancel', $pengaduan->id) }}" method="POST">
                            @csrf
                            <button type="button" onclick="confirmCancel()"
                                class="bg-red-500 text-white px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all shadow-sm">
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mb-8">
                                @php
                                    $firstDetail = $pengaduan->details->first();
                                    $lastDetail = $pengaduan->details->last();
                                    $user = $firstDetail->user;
                                    $fotoAwal = $firstDetail->fotos->first();
                                @endphp
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nomor
                                        Pengaduan</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $pengaduan->nomor_pengaduan }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama
                                        Warga</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $user->nama_warga ?? '-' }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal
                                        Pengaduan</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ \Carbon\Carbon::parse($firstDetail->tgl)->format('d-m-Y H:i') }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">NIK</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $user->nik ?? '-' }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $pengaduan->kategori->kategori ?? '-' }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">No.
                                        Telepon</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $user->no_tlp ?? '-' }}</div>
                                </div>

                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $user->alamat ?? '-' }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Email</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $user->email ?? '-' }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status
                                        Terakhir</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $lastDetail->status->status ?? 'Unknown' }}</div>
                                </div>
                                <div class="space-y-2 group">
                                    <label
                                        class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">RT</label>
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                        {{ $user->rt->nama_rt ?? '-' }}</div>
                                </div>
                            </div>

                            <!-- Full Width Subject -->
                            <div class="space-y-2 group">
                                <label
                                    class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Subject</label>
                                <div
                                    class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-gray-700 shadow-sm">
                                    {{ $pengaduan->subject }}
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Section: Riwayat Tindak Lanjut -->
                    <div class="space-y-8">
                        <div class="border-b border-gray-100 pb-5">
                            <h3 class="text-2xl font-black text-black tracking-tight">Riwayat Tindak Lanjut</h3>
                        </div>

                        <div class="space-y-6">
                            @foreach($pengaduan->details->sortBy('tgl') as $index => $tindak)
                                <div
                                    class="border border-gray-200 rounded-[32px] p-10 space-y-8 bg-white shadow-sm hover:shadow-md transition-all border-2">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-2">
                                            <label
                                                class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status</label>
                                            <div
                                                class="bg-white border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-medium text-black shadow-sm">
                                                {{ $tindak->status->status ?? 'Unknown' }}
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">User</label>
                                            <div
                                                class="bg-white border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-medium text-black shadow-sm">
                                                {{ $tindak->user->nama_warga ?? 'System' }}
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pengaduan</label>
                                            <div
                                                class="bg-white border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-medium text-black shadow-sm">
                                                {{ \Carbon\Carbon::parse($tindak->tgl)->format('d-m-Y H:i') }}
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Role</label>
                                            <div
                                                class="bg-white border border-gray-200 rounded-2xl px-6 py-3.5 text-sm font-normal text-black shadow-sm">
                                                {{ $tindak->user->role->name_role ?? 'Warga' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Detail Pengaduan</label>
                                        <div
                                            class="bg-white border border-gray-200 rounded-2xl px-6 py-5 text-sm font-normal text-black shadow-sm leading-relaxed min-h-[80px]">
                                            {{ $tindak->detail_pengaduan }}
                                        </div>
                                    </div>
                                    @if($tindak->fotos->count() > 0)
                                        <div class="flex items-center text-sm font-black text-gray-700 ml-1 mt-4">
                                            <span class="mr-2">Download File:</span>
                                            @foreach($tindak->fotos as $foto)
                                                <a href="{{ asset('storage/' . $foto->nama_file) }}" target="_blank"
                                                    class="text-blue-500 hover:underline italic mr-2">
                                                    {{ basename($foto->nama_file) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Timeline -->
        <div class="lg:col-span-4">
            <div class="sticky top-32">
                <div class="card !p-10 shadow-xl border border-gray-100">
                    <h4 class="font-black text-xl text-black mb-10 border-b border-gray-50 pb-6 tracking-tight">Status
                        Timeline</h4>

                    <div class="relative pl-16 space-y-12">
                        <!-- Timeline Line -->
                        <div class="absolute left-[29px] top-2 bottom-2 w-0.5 bg-gray-100"></div>

                        @php
                            $steps = [
                                ['label' => 'New', 'id' => 10],
                                ['label' => 'On Progress', 'id' => 20],
                                ['label' => 'Done', 'id' => 30],
                                ['label' => 'Cancel', 'id' => 40],
                            ];

                            $allStatusIds = $pengaduan->details->pluck('pengaduan_status_id')->toArray();
                            $currentStatusId = $pengaduan->details->last()->pengaduan_status_id;
                        @endphp

                        @foreach($steps as $index => $step)
                            @php
                                $isReached = in_array($step['id'], $allStatusIds);
                                $isCurrent = $currentStatusId == $step['id'];
                                $isCancel = $step['label'] == 'Cancel';

                                // Skip cancel if not cancelled, unless it's the current status
                                if ($isCancel && !$isReached)
                                    continue;

                                $bgClass = 'bg-white';
                                $borderClass = 'border-gray-200';
                                $textClass = 'text-gray-400';

                                if ($isReached) {
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

                                $detailForStep = $pengaduan->details->where('pengaduan_status_id', $step['id'])->first();
                                $shouldPulse = $isCurrent && in_array($step['label'], ['New', 'On Progress']);
                            @endphp

                            <div class="relative">
                                <div class="absolute -left-[45px] top-1 w-5 h-5 flex items-center justify-center z-10">
                                    @if($shouldPulse)
                                        <div class="absolute w-full h-full rounded-full {{ $bgClass }} animate-ping opacity-40">
                                        </div>
                                    @endif
                                    <div
                                        class="relative w-5 h-5 {{ $bgClass }} border-2 {{ $borderClass }} rounded-full flex items-center justify-center shadow-sm">
                                        @if($isReached)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h6 class="font-bold text-md {{ $textClass }} tracking-tight">{{ $step['label'] }}</h6>
                                    <p class="text-[11px] {{ $textClass }} opacity-70 mt-1 font-medium">
                                        {{ $detailForStep ? \Carbon\Carbon::parse($detailForStep->tgl)->format('d M Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection