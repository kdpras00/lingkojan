<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;
use App\Models\PengaduanDetail;
use App\Models\PengaduanFoto;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function show($id) 
    { 
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user.role', 'details.status', 'details.fotos'])->findOrFail($id);
        return view('petugas.pengaduan.show', compact('pengaduan')); 
    }

    public function storeTindakLanjut(Request $request, $id)
    {
        $header = PengaduanHeader::findOrFail($id);
        $latestDetail = $header->details()->latest('tgl')->first();

        if (in_array($latestDetail->pengaduan_status_id, [30, 40])) { // Done or Cancel
            return redirect()->back()->with('error', 'Status laporan sudah final.');
        }

        $statusMap = [
            'On Progress' => 20,
            'Done' => 30,
            'Cancel' => 40,
        ];

        $request->validate([
            'status' => 'required|in:On Progress,Done,Cancel',
            'detail' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $newDetail = PengaduanDetail::create([
                'detail_pengaduan' => $request->detail,
                'tgl' => now(),
                'pengaduan_header_id' => $header->id,
                'pengaduan_status_id' => $statusMap[$request->status],
                'users_id' => auth()->id(),
            ]);

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('tindak_lanjut', 'public');
                PengaduanFoto::create([
                    'nama_file' => $fotoPath,
                    'pengaduan_detail_id' => $newDetail->id,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil memberikan tanggapan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
