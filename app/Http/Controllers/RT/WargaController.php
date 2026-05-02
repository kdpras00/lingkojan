<?php
namespace App\Http\Controllers\RT;
use App\Http\Controllers\Controller;
class WargaController extends Controller {
    public function index()
    {
        $userRt = auth()->user()->rt ?? '001';
        $warga = \App\Models\User::role('warga')->where('rt', $userRt)->get();
        return view('rt.warga.index', compact('warga', 'userRt'));
    }
    public function show($id) { return view('rt.warga.show'); }
}
