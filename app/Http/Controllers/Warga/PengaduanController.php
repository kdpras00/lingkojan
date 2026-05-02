<?php
namespace App\Http\Controllers\Warga;
use App\Http\Controllers\Controller;
class PengaduanController extends Controller {
    public function index() 
    { 
        $pengaduans = \App\Models\Pengaduan::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('warga.pengaduan.index', compact('pengaduans')); 
    }

    public function create() { 
        return view('warga.pengaduan.create'); 
    }

    public function show($id) 
    { 
        $pengaduan = \App\Models\Pengaduan::where('user_id', auth()->id())
            ->with(['tindakLanjuts.user'])
            ->findOrFail($id);
        return view('warga.pengaduan.show', compact('pengaduan')); 
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        
        // Generate nomor_pengaduan: P-YYYYMMDD-XXXX
        $countToday = \App\Models\Pengaduan::whereDate('created_at', now())->count();
        $nomor = 'P-' . now()->format('Ymd') . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduans', 'public');
        }

        \App\Models\Pengaduan::create([
            'user_id' => $user->id,
            'nomor_pengaduan' => $nomor,
            'kategori' => $request->kategori,
            'subjek' => $request->subjek,
            'alamat' => $request->deskripsi, // Using alamat for description as per migration for now or we can use another field
            'rt' => $user->rt ?? '001',
            'rw' => $user->rw ?? '001',
            'foto' => $fotoPath,
            'status' => 'New',
        ]);

        return redirect()->route('warga.dashboard')->with('success', 'Pengaduan berhasil dikirim.');
    }
        public function cancel($id)
    {
        $pengaduan = \App\Models\Pengaduan::where('user_id', auth()->id())
            ->where('status', 'New')
            ->findOrFail($id);

        $pengaduan->update(['status' => 'Cancel']);

        $pengaduan->tindakLanjuts()->create([
            'user_id' => auth()->id(),
            'status' => 'Cancel',
            'detail' => 'Laporan dibatalkan oleh pelapor.',
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dibatalkan.');
    }
}
