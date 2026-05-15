<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;
use App\Models\PengaduanDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $allPengaduans = PengaduanHeader::with('details')->get();
        $stats = [
            'total' => $allPengaduans->count(),
            'new' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 10)->count(),
            'progress' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 20)->count(),
            'done' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 30)->count(),
            'cancel' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 40)->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function menu() 
    { 
        return view('admin.menu'); 
    }

    public function search(Request $request)
    {
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);
        if ($request->has('q') && $request->q != '') {
            $query->where('nomor_pengaduan', 'LIKE', '%' . $request->q . '%')
                  ->orWhere('subject', 'LIKE', '%' . $request->q . '%');
        }
        $results = $query->get();
        return view('admin.pencarian', compact('results'));
    }
}
