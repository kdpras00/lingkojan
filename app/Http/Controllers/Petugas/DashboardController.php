<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;
use App\Models\PengaduanDetail;
use App\Models\PengaduanStatus;
use App\Models\PengaduanKategori;

class DashboardController extends Controller
{
    public function index(Request $request) 
    { 
        $allPengaduans = PengaduanHeader::with('details')->get();
        $stats = [
            'total'    => $allPengaduans->count(),
            'new'      => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 10)->count(),
            'progress' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 20)->count(),
            'done'     => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 30)->count(),
        ];

        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);

        // Search
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nomor_pengaduan', 'like', "%{$searchTerm}%")
                  ->orWhere('subject', 'like', "%{$searchTerm}%")
                  ->orWhereHas('details.user', function ($u) use ($searchTerm) {
                      $u->where('nama_warga', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Filter by status (latest status only)
        if ($request->filled('status')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status)
                  ->whereIn('id', function ($sub) {
                      $sub->selectRaw('MAX(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('pengaduan_kategori_id', $request->kategori_id);
        }

        // Filter by start date (submission date)
        if ($request->filled('start_date')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->whereDate('tgl', '>=', $request->start_date)
                  ->whereIn('id', function ($sub) {
                      $sub->selectRaw('MIN(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        // Filter by end date (submission date)
        if ($request->filled('end_date')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->whereDate('tgl', '<=', $request->end_date)
                  ->whereIn('id', function ($sub) {
                      $sub->selectRaw('MIN(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        $recentPengaduans = $query->get();
        $statuses  = PengaduanStatus::all();
        $kategoris = PengaduanKategori::all();

        return view('petugas.dashboard', compact('stats', 'recentPengaduans', 'statuses', 'kategoris')); 
    }
}
