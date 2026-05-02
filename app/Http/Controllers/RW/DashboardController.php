<?php
namespace App\Http\Controllers\RW;
use App\Http\Controllers\Controller;
class DashboardController extends Controller {
    public function index(\Illuminate\Http\Request $request)
    {
        $stats = [
            'total' => \App\Models\Pengaduan::count(),
            'new' => \App\Models\Pengaduan::where('status', 'New')->count(),
            'progress' => \App\Models\Pengaduan::where('status', 'On Progress')->count(),
            'done' => \App\Models\Pengaduan::where('status', 'Done')->count(),
            'cancel' => \App\Models\Pengaduan::where('status', 'Cancel')->count(),
        ];

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

        $recentPengaduans = $query->orderBy('created_at', 'desc')
            ->get();

        return view('rw.dashboard', compact('stats', 'recentPengaduans'));
    }
}
