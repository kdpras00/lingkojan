<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of complaints.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Pengaduan::with('user');

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nomor_pengaduan', 'like', "%{$searchTerm}%")
                  ->orWhere('subjek', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($u) use ($searchTerm) {
                      $u->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Display the specified complaint.
     */
    public function show($id)
    {
        $pengaduan = \App\Models\Pengaduan::with(['user', 'tindakLanjuts.user'])->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function print($id) 
    { 
        $pengaduan = \App\Models\Pengaduan::with(['user', 'tindakLanjuts.user'])->findOrFail($id);
        return view('rt.pengaduan.print', compact('pengaduan')); 
    }
}
