<?php
namespace App\Http\Controllers\RW;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WargaController extends Controller {
    public function index(Request $request)
    {
        $query = \App\Models\User::role('warga');
        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }
        $wargas = $query->get();
        
        $availableRts = \App\Models\User::role('warga')->whereNotNull('rt')->distinct()->pluck('rt');
        
        return view('rw.warga.index', compact('wargas', 'availableRts'));
    }
}
