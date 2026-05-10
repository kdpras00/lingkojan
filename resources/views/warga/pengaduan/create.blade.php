@extends('layouts.warga')

@section('title', 'Buat Pengaduan')
@section('page_title', 'Buat Pengaduan')

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

<div class="max-w-4xl">
    <!-- Informasi Akun -->
    <div class="card mb-8">
        <div class="mb-8 text-center md:text-left">
            <h4 class="text-xl font-black text-black uppercase tracking-tight">Informasi Akun</h4>
            <p class="text-sm text-gray-500 font-medium mt-1">Data profil Anda saat ini.</p>
        </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Nama</label>
                <input type="text" value="{{ auth()->user()->nama_warga }}" class="w-full px-6 py-4 bg-gray-100/80 border border-gray-200 rounded-2xl text-sm font-bold text-gray-500 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Email</label>
                <input type="email" value="{{ auth()->user()->email }}" class="w-full px-6 py-4 bg-gray-100/80 border border-gray-200 rounded-2xl text-sm font-bold text-gray-500 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">RT</label>
                <input type="text" value="{{ auth()->user()->rt->nama_rt ?? '-' }}" class="w-full px-6 py-4 bg-gray-100/80 border border-gray-200 rounded-2xl text-sm font-bold text-gray-500 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Alamat</label>
                <input type="text" value="{{ auth()->user()->alamat }}" class="w-full px-6 py-4 bg-gray-100/80 border border-gray-200 rounded-2xl text-sm font-bold text-gray-500 cursor-not-allowed" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="mb-10 text-center md:text-left">
            <h4 class="text-2xl font-black text-black uppercase tracking-tight">Buat Pengaduan Baru</h4>
            <p class="text-sm text-gray-500 font-medium mt-1">Lengkapi formulir di bawah ini untuk melaporkan permasalahan.</p>
        </div>

        <form action="{{ route('warga.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Judul Laporan -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Subject Pengaduan<span class="text-red-500">*</span></label>
                    <input type="text" name="subjek" value="{{ old('subjek') }}" placeholder="Contoh: Jalan Rusak di RT 07" class="w-full px-6 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all @error('subjek') border-red-500 @enderror">
                    @error('subjek') <p class="text-red-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Kategori<span class="text-red-500">*</span></label>
                    <select name="kategori" class="w-full px-6 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22currentColor%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1.25rem_center] bg-no-repeat @error('kategori') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ old('kategori') == $k->id ? 'selected' : '' }}>{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <p class="text-red-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Isi Laporan -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Detail Pengaduan<span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="6" placeholder="Jelaskan secara detail permasalahan yang terjadi..." class="w-full px-6 py-5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-medium text-gray-700 focus:outline-none focus:ring-4 focus:ring-orange-500/5 focus:border-[#f07c1b] transition-all @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-[10px] font-black uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Upload Bukti -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-black mb-3">Uploud File (Optional)</label>
                    <div class="relative group">
                        <input type="file" name="foto" id="foto-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                        <div id="dropzone" class="flex flex-col items-center justify-center p-12 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl group-hover:bg-orange-50/50 group-hover:border-[#f07c1b] transition-all @error('foto') border-red-500 @enderror relative">
                            <div id="preview-container" class="hidden mb-6 relative z-30">
                                <img id="preview-img" src="#" alt="Preview" class="max-h-64 rounded-2xl shadow-2xl border-4 border-white cursor-pointer hover:scale-[1.02] transition-transform" onclick="openImagePreview(this.src)">
                                <button type="button" onclick="removePreview()" class="absolute -top-4 -right-4 bg-red-500 text-white p-2 rounded-full shadow-lg hover:bg-red-600 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <svg id="upload-icon" class="w-16 h-16 text-gray-300 group-hover:text-[#f07c1b] mb-4 transition-transform group-hover:scale-110 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p id="upload-text" class="text-base font-black text-gray-400 group-hover:text-[#f07c1b] tracking-tight">Klik atau seret file foto ke sini</p>
                            <p class="text-xs text-gray-400 mt-2 font-medium">Format: JPG, PNG, JPEG (Maks. 2MB)</p>
                        </div>
                        @error('foto') <p class="text-red-500 text-xs mt-3 text-center font-black uppercase tracking-widest">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-end items-center gap-6 mt-12 pt-8 border-t border-gray-100">
                <a href="{{ route('warga.pengaduan.index') }}" class="text-sm font-black text-gray-500 hover:text-black transition-colors px-8 py-3 border-2 border-transparent hover:border-black rounded-none">Batal</a>
                <button type="submit" class="bg-white border-2 border-black text-black px-12 py-3 rounded-none text-[11px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] flex items-center group/btn w-full md:w-auto justify-center">
                    Kirim Pengaduan
                    <svg class="w-4 h-4 ml-3 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

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

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('foto-input');
        const previewContainer = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-img');
        const uploadIcon = document.getElementById('upload-icon');
        const uploadText = document.getElementById('upload-text');
        const dropzone = document.getElementById('dropzone');

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Check if file is image
                    if (!file.type.startsWith('image/')) {
                        alert('Mohon unggah file gambar (JPG, PNG, JPEG)');
                        this.value = '';
                        return;
                    }

                    // Check file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImg.src = event.target.result;
                        previewContainer.classList.remove('hidden');
                        uploadIcon.classList.add('hidden');
                        
                        // Truncate long file names
                        let fileName = file.name;
                        if (fileName.length > 25) {
                            fileName = fileName.substring(0, 22) + '...';
                        }
                        uploadText.textContent = fileName;
                        uploadText.classList.add('text-[#f07c1b]');
                        dropzone.classList.add('border-[#f07c1b]', 'bg-orange-50/50');
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removePreview = function(e) {
            if (e) e.stopPropagation();
            fileInput.value = '';
            previewContainer.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            uploadText.textContent = 'Klik atau seret file foto ke sini';
            uploadText.classList.remove('text-[#f07c1b]');
            dropzone.classList.remove('border-[#f07c1b]', 'bg-orange-50/50');
            previewImg.src = '#';
        };

        // Handle Escape key for modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeImagePreview();
        });
    });
</script>
@endpush
