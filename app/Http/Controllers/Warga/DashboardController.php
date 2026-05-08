<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PengaduanHeader;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $myPengaduans = PengaduanHeader::whereHas('details', function($q) use ($user_id) {
            $q->where('users_id', $user_id);
        })->with(['details.status', 'kategori'])->orderBy('id', 'desc')->get();
            
        $stats = [
            'total' => $myPengaduans->count(),
            'process' => $myPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 20)->count(),
            'done' => $myPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 30)->count(),
            'cancel' => $myPengaduans->filter(fn($p) => $p->details->last()->pengaduan_status_id == 40)->count(),
        ];
            
        return view('warga.dashboard', compact('myPengaduans', 'stats'));
    }
}
