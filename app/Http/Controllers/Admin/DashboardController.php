<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
class DashboardController extends Controller {
    public function index()
    {
        $stats = [
            'total' => \App\Models\Pengaduan::count(),
            'new' => \App\Models\Pengaduan::where('status', 'New')->count(),
            'progress' => \App\Models\Pengaduan::where('status', 'On Progress')->count(),
            'done' => \App\Models\Pengaduan::where('status', 'Done')->count(),
            'cancel' => \App\Models\Pengaduan::where('status', 'Cancel')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
    public function menu() { return view('admin.menu'); }
    public function search(Request $request)
    {
        $query = \App\Models\Pengaduan::with('user');
        if ($request->has('q') && $request->q != '') {
            $query->where('nomor_pengaduan', 'LIKE', '%' . $request->q . '%')
                  ->orWhere('subjek', 'LIKE', '%' . $request->q . '%');
        }
        $results = $query->get();
        return view('admin.pencarian', compact('results'));
    }
}
