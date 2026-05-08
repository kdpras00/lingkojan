<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\PengaduanHeader;

class PengaduanController extends Controller
{
    public function show($id) 
    { 
        $userRtId = auth()->user()->rt_id;
        $pengaduan = PengaduanHeader::whereHas('details.user', function($q) use ($userRtId) {
                $q->where('rt_id', $userRtId);
            })
            ->with(['kategori', 'details.user', 'details.status', 'details.fotos', 'details.komentar.user'])
            ->findOrFail($id);
            
        return view('rt.pengaduan.show', compact('pengaduan', 'userRtId')); 
    }

    public function print($id) 
    { 
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user', 'details.status'])->findOrFail($id);
        return view('rt.pengaduan.print', compact('pengaduan')); 
    }
}
