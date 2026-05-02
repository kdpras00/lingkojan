<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the RT dashboard.
     */
    public function index(Request $request)
    {
        $userRt = auth()->user()->rt ?? '001';
        
        $stats = [
            'total' => \App\Models\Pengaduan::where('rt', $userRt)->count(),
            'new' => \App\Models\Pengaduan::where('rt', $userRt)->where('status', 'New')->count(),
            'progress' => \App\Models\Pengaduan::where('rt', $userRt)->where('status', 'On Progress')->count(),
            'done' => \App\Models\Pengaduan::where('rt', $userRt)->where('status', 'Done')->count(),
            'cancel' => \App\Models\Pengaduan::where('rt', $userRt)->where('status', 'Cancel')->count(),
        ];

        $query = \App\Models\Pengaduan::where('rt', $userRt)
            ->with('user');

        // Apply Search
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

        // Apply Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

        $recentPengaduans = $query->orderBy('created_at', 'desc')
            ->get();

        return view('rt.dashboard', compact('stats', 'recentPengaduans', 'userRt'));
    }
}
