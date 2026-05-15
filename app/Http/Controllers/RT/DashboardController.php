<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;
use App\Models\PengaduanDetail;

class DashboardController extends Controller
{
    /**
     * Display the RT dashboard.
     */
    public function index(Request $request)
    {
        $userRtId = auth()->user()->rt_id;
        
        $allPengaduans = PengaduanHeader::whereHas('details.user', function($q) use ($userRtId) {
            $q->where('rt_id', $userRtId);
        })->with('details')->get();

        $stats = [
            'total' => $allPengaduans->count(),
            'new' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 10)->count(),
            'progress' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 20)->count(),
            'done' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 30)->count(),
            'cancel' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 40)->count(),
        ];

        $query = PengaduanHeader::whereHas('details.user', function($q) use ($userRtId) {
            $q->where('rt_id', $userRtId);
        })->with(['kategori', 'details.status', 'details.user']);

        // Apply Search
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

        // Apply Filters
        if ($request->filled('status')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status);
            });
        }

        if ($request->filled('kategori')) {
            $query->where('pengaduan_kategori_id', $request->kategori);
        }

        if ($request->filled('start_date')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '>=', $request->start_date);
            });
        }

        if ($request->filled('end_date')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '<=', $request->end_date);
            });
        }

        $recentPengaduans = $query->get();
        $categories = \App\Models\PengaduanKategori::all();
        $statuses = \App\Models\PengaduanStatus::all();
        $userRt = \App\Models\Rt::find($userRtId)->nama_rt ?? '-';

        return view('rt.dashboard', compact('stats', 'recentPengaduans', 'userRt', 'categories', 'statuses'));
    }
}
