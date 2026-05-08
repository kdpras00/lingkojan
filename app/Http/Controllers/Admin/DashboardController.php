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
        $stats = [
            'total' => PengaduanHeader::count(),
            'new' => PengaduanDetail::where('pengaduan_status_id', 10)->count(),
            'progress' => PengaduanDetail::where('pengaduan_status_id', 20)->count(),
            'done' => PengaduanDetail::where('pengaduan_status_id', 30)->count(),
            'cancel' => PengaduanDetail::where('pengaduan_status_id', 40)->count(),
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
