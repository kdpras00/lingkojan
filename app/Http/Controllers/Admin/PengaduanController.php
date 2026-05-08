<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;

class PengaduanController extends Controller
{
    /**
     * Display a listing of complaints.
     */
    public function index(Request $request)
    {
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nomor_pengaduan', 'like', "%{$searchTerm}%")
                  ->orWhere('subject', 'like', "%{$searchTerm}%")
                  ->orWhereHas('details.user', function($u) use ($searchTerm) {
                      $u->where('nama_warga', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $pengaduans = $query->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Display the specified complaint.
     */
    public function show($id)
    {
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user', 'details.status', 'details.fotos', 'details.komentar.user'])->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function print($id) 
    { 
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user', 'details.status'])->findOrFail($id);
        return view('rt.pengaduan.print', compact('pengaduan')); 
    }
}
