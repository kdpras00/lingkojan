<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengaduanDetail;
use App\Models\PengaduanFoto;
use App\Models\PengaduanHeader;
use App\Models\PengaduanKategori;
use App\Models\PengaduanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = PengaduanHeader::whereHas('details', function ($query) {
            $query->where('users_id', auth()->id());
        })
        ->with(['details' => function ($query) {
            $query->latest('tgl')->limit(1);
        }, 'details.status', 'kategori'])
        ->get();

        return view('warga.pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = PengaduanKategori::all();
        return view('warga.pengaduan.create', compact('kategoris'));
    }

    public function show($id)
    {
        $pengaduan = PengaduanHeader::with(['details.user', 'details.status', 'details.fotos', 'details.komentar.user', 'kategori'])
            ->whereHas('details', function ($query) {
                $query->where('users_id', auth()->id());
            })
            ->findOrFail($id);

        return view('warga.pengaduan.show', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:45',
            'kategori' => 'required|exists:pengaduan_kategori,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Generate nomor_pengaduan: P-YYYYMMDD-XXXX
            $countToday = PengaduanHeader::whereDate('nomor_pengaduan', 'like', 'P-' . now()->format('Ymd') . '-%')->count();
            $nomor = 'P-' . now()->format('Ymd') . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

            $header = PengaduanHeader::create([
                'subject' => $request->subjek,
                'nomor_pengaduan' => $nomor,
                'pengaduan_kategori_id' => $request->kategori,
            ]);

            $detail = PengaduanDetail::create([
                'detail_pengaduan' => $request->deskripsi,
                'tgl' => now(),
                'pengaduan_header_id' => $header->id,
                'pengaduan_status_id' => 10, // New
                'users_id' => auth()->id(),
            ]);

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('pengaduans', 'public');
                PengaduanFoto::create([
                    'nama_file' => $fotoPath,
                    'pengaduan_detail_id' => $detail->id,
                ]);
            }

            DB::commit();
            return redirect()->route('warga.dashboard')->with('success', 'Pengaduan berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cancel($id)
    {
        $header = PengaduanHeader::findOrFail($id);
        
        // Get latest detail to check status
        $latestDetail = $header->details()->latest('tgl')->first();

        if ($latestDetail->pengaduan_status_id != 10) {
            return redirect()->back()->with('error', 'Laporan tidak dapat dibatalkan.');
        }

        PengaduanDetail::create([
            'detail_pengaduan' => 'Laporan dibatalkan oleh pelapor.',
            'tgl' => now(),
            'pengaduan_header_id' => $header->id,
            'pengaduan_status_id' => 40, // Cancel
            'users_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dibatalkan.');
    }
}
