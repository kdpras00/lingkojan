<?php
namespace App\Http\Controllers\RW;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasController extends Controller {
    public function index()
    {
        $petugas = \App\Models\User::role('petugas')->get();
        return view('rw.petugas.index', compact('petugas'));
    }
}
