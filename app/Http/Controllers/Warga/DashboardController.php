<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $myPengaduans = \App\Models\Pengaduan::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $stats = [
            'total' => $myPengaduans->count(),
            'process' => $myPengaduans->where('status', 'On Progress')->count(),
            'done' => $myPengaduans->where('status', 'Done')->count(),
            'cancel' => $myPengaduans->where('status', 'Cancel')->count(),
        ];
            
        return view('warga.dashboard', compact('myPengaduans', 'stats'));
    }
}
