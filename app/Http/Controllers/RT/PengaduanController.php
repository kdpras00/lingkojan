<?php
namespace App\Http\Controllers\RT;
use App\Http\Controllers\Controller;
class PengaduanController extends Controller {
    public function show($id) 
    { 
        $userRt = auth()->user()->rt ?? '001';
        $pengaduan = \App\Models\Pengaduan::where('rt', $userRt)
            ->with(['user', 'tindakLanjuts.user'])
            ->findOrFail($id);
            
        return view('rt.pengaduan.show', compact('pengaduan', 'userRt')); 
    }
    public function print($id) 
    { 
        $pengaduan = \App\Models\Pengaduan::with(['user', 'tindakLanjuts.user'])->findOrFail($id);
        return view('rt.pengaduan.print', compact('pengaduan')); 
    }
}
