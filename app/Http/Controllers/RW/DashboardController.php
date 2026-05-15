<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;
use App\Models\PengaduanDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $allPengaduans = PengaduanHeader::with('details')->get();
        $stats = [
            'total' => $allPengaduans->count(),
            'new' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 10)->count(),
            'progress' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 20)->count(),
            'done' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 30)->count(),
            'cancel' => $allPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 40)->count(),
        ];

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

        $recentPengaduans = $query->get();

        $wargaStats = User::where('role_id', 1) // 1 = Warga
            ->with('rt')
            ->select('rt_id', DB::raw('count(*) as total'))
            ->groupBy('rt_id')
            ->get();

        return view('rw.dashboard', compact('stats', 'recentPengaduans', 'wargaStats'));
    }
}
