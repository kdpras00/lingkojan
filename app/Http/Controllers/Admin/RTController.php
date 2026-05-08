<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rt;

class RTController extends Controller
{
    public function index()
    {
        $rts = Rt::all();
        return view('admin.rt.index', compact('rts'));
    }
    
    public function create() 
    { 
        return view('admin.rt.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rt' => ['required', 'string', 'unique:rt,nama_rt', 'max:45'],
        ]);

        Rt::create([
            'nama_rt' => $request->nama_rt,
        ]);

        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil ditambahkan!');
    }
    
    public function edit($id) 
    { 
        $rt = Rt::findOrFail($id);
        return view('admin.rt.edit', compact('rt')); 
    }

    public function update(Request $request, $id)
    {
        $rt = Rt::findOrFail($id);

        $request->validate([
            'nama_rt' => ['required', 'string', 'unique:rt,nama_rt,'.$rt->id, 'max:45'],
        ]);

        $rt->update([
            'nama_rt' => $request->nama_rt,
        ]);

        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rt = Rt::findOrFail($id);
        $rt->delete();
        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil dihapus!');
    }
}
