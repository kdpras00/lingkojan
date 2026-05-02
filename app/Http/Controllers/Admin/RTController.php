<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RukunTetangga;

class RTController extends Controller {
    
    public function index()
    {
        $rts = RukunTetangga::all();
        return view('admin.rt.index', compact('rts'));
    }
    
    public function create() 
    { 
        return view('admin.rt.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => ['required', 'string', 'unique:rukun_tetangga,nomor'],
            'nama_ketua' => ['nullable', 'string', 'max:255'],
        ]);

        RukunTetangga::create([
            'nomor' => $request->nomor,
            'nama_ketua' => $request->nama_ketua,
        ]);

        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil ditambahkan!');
    }
    
    public function edit($id) 
    { 
        $rt = RukunTetangga::findOrFail($id);
        return view('admin.rt.edit', compact('rt')); 
    }

    public function update(Request $request, $id)
    {
        $rt = RukunTetangga::findOrFail($id);

        $request->validate([
            'nomor' => ['required', 'string', 'unique:rukun_tetangga,nomor,'.$rt->id],
            'nama_ketua' => ['nullable', 'string', 'max:255'],
        ]);

        $rt->update([
            'nomor' => $request->nomor,
            'nama_ketua' => $request->nama_ketua,
        ]);

        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rt = RukunTetangga::findOrFail($id);
        $rt->delete();
        return redirect()->route('admin.rt.index')->with('success', 'Data RT berhasil dihapus!');
    }
}
