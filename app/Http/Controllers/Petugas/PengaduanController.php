<?php
namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaduanController extends Controller {
    public function show($id) 
    { 
        $pengaduan = \App\Models\Pengaduan::with(['user', 'tindakLanjuts.user'])->findOrFail($id);
        return view('petugas.pengaduan.show', compact('pengaduan')); 
    }

    public function storeTindakLanjut(Request $request, $id)
    {
        $pengaduan = \App\Models\Pengaduan::findOrFail($id);

        // Allow all transitions for non-final status (as requested: not stepwise)
        if (in_array($pengaduan->status, ['Done', 'Cancel'])) {
            return redirect()->back()->with('error', 'Status laporan sudah final.');
        }
        $allowed = ['On Progress', 'Done', 'Cancel'];

        $request->validate([
            'status' => 'required|in:' . implode(',', $allowed),
            'detail' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);
        
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('tindak_lanjut', 'public');
        }

        $pengaduan->tindakLanjuts()->create([
            'user_id' => auth()->id(),
            'status' => $request->status,
            'detail' => $request->detail,
            'foto' => $fotoPath,
        ]);

        $pengaduan->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Berhasil memberikan tanggapan.');
    }
}
