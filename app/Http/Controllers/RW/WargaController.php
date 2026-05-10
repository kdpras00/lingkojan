<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\User;

class WargaController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = User::where('role_id', 1)->with('rt'); // 1 = Warga
        
        if ($request->filled('rt')) {
            $query->whereHas('rt', function($q) use ($request) {
                $q->where('nama_rt', $request->rt);
            });
        }
        
        $wargas = $query->get();
        $availableRts = \App\Models\Rt::all();
        
        return view('rw.warga.index', compact('wargas', 'availableRts'));
    }

    public function show($id) 
    { 
        $warga = User::where('role_id', 1)->with('rt')->findOrFail($id);
        return view('rw.warga.show', compact('warga')); 
    }
}
