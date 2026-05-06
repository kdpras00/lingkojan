<?php
namespace App\Http\Controllers\RW;
use App\Http\Controllers\Controller;
class PengaduanController extends Controller {
    public function index(\Illuminate\Http\Request $request)
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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->get();
        $availableRts = \App\Models\Pengaduan::distinct()->whereNotNull('rt')->pluck('rt');
        $availableKategoris = \App\Models\Pengaduan::distinct()->whereNotNull('kategori')->pluck('kategori');

        return view('rw.pengaduan.index', compact('pengaduans', 'availableRts', 'availableKategoris'));
    }

    public function recap(\Illuminate\Http\Request $request) 
    { 
        $query = \App\Models\Pengaduan::select('rt', 'kategori', 'status', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('rt', 'kategori', 'status');

        if ($request->rt) {
            $query->where('rt', $request->rt);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $recap = $query->get();
        
        // Get all unique RTs and Kategori for filter
        $availableRts = \App\Models\Pengaduan::distinct()->whereNotNull('rt')->pluck('rt');
        $availableKategoris = \App\Models\Pengaduan::distinct()->whereNotNull('kategori')->pluck('kategori');

        return view('rw.pengaduan.recap', compact('recap', 'availableRts', 'availableKategoris')); 
    }

    public function recapDetail(\Illuminate\Http\Request $request) 
    { 
        $query = \App\Models\Pengaduan::with('user');

        if ($request->rt) {
            $query->where('rt', $request->rt);
        }
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->get();
        $availableRts = \App\Models\Pengaduan::distinct()->pluck('rt');

        return view('rw.pengaduan.recap-detail', compact('pengaduans', 'availableRts')); 
    }

    public function print($id) 
    { 
        $pengaduan = \App\Models\Pengaduan::with(['user', 'tindakLanjuts.user'])->findOrFail($id);
        return view('rt.pengaduan.print', compact('pengaduan')); 
    }

    public function show($id) 
    { 
        $pengaduan = \App\Models\Pengaduan::with(['user', 'tindakLanjuts.user'])->findOrFail($id);
        return view('rw.pengaduan.show', compact('pengaduan')); 
    }
}
