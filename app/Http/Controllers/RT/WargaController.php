<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\User;

class WargaController extends Controller
{
    public function index()
    {
        $userRtId = auth()->user()->rt_id;
        $warga = User::where('role_id', 1)->where('rt_id', $userRtId)->get(); // 1 = Warga
        return view('rt.warga.index', compact('warga', 'userRtId'));
    }

    public function show($id) 
    { 
        $warga = User::where('role_id', 1)->findOrFail($id);
        return view('rt.warga.show', compact('warga')); 
    }
}
