<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Models\User;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role_id', 4)->get(); // 4 = Petugas
        return view('rw.petugas.index', compact('petugas'));
    }

    public function show($id) 
    { 
        $petugas = User::where('role_id', 4)->findOrFail($id);
        return view('rw.petugas.show', compact('petugas')); 
    }
}
