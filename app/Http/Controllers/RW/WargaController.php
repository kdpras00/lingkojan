<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\User;

class WargaController extends Controller
{
    public function index()
    {
        $warga = User::where('role_id', 1)->with('rt')->get(); // 1 = Warga
        return view('rw.warga.index', compact('warga'));
    }

    public function show($id) 
    { 
        $warga = User::where('role_id', 1)->with('rt')->findOrFail($id);
        return view('rw.warga.show', compact('warga')); 
    }
}
