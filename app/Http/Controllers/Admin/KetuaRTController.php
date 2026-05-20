<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rt;
use Illuminate\Support\Facades\Hash;

class KetuaRTController extends Controller
{
    public function index()
    {
        $ketuaRts = User::where('role_id', 2)->with('rt')->get(); // 2 = Ketua RT
        return view('admin.ketua_rt.index', compact('ketuaRts'));
    }
    
    public function create() 
    { 
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.ketua_rt.create', compact('rts')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users'],
            'rt_id'      => ['required', 'exists:rt,id'],
        ], [
            'nama_warga.regex'      => 'Nama hanya boleh berisi huruf dan spasi.',
            'username.min'          => 'Username minimal 3 karakter.',
            'username.alpha_num'    => 'Username hanya boleh berisi huruf dan angka.',
        ]);

        User::create([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'email'      => $request->username . '@lingkojan.com',
            'rt_id'      => $request->rt_id,
            'role_id'    => 2, // Ketua RT
            'password'   => Hash::make('password'),
            'no_tlp'     => '-', // placeholder
            'alamat'     => '-', // placeholder
        ]);

        return redirect()->route('admin.ketua_rt.index')->with('success', 'Akun Ketua RT berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $ketuaRt = User::where('role_id', 2)->with('rt')->findOrFail($id);
        return view('admin.ketua_rt.show', compact('ketuaRt')); 
    }
    
    public function edit($id) 
    { 
        $ketuaRt = User::where('role_id', 2)->findOrFail($id);
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.ketua_rt.edit', compact('ketuaRt', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $ketuaRt = User::where('role_id', 2)->findOrFail($id);

        $rules = [
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users,username,'.$ketuaRt->id],
            'rt_id'      => ['required', 'exists:rt,id'],
        ];

        $request->validate($rules);

        $ketuaRt->update([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'rt_id'      => $request->rt_id,
        ]);

        return redirect()->route('admin.ketua_rt.index')->with('success', 'Akun Ketua RT berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ketuaRt = User::where('role_id', 2)->findOrFail($id);

        if ($ketuaRt->pengaduanDetails()->exists()) {
            return redirect()->route('admin.ketua_rt.index')->with('error', 'Akun Ketua RT tidak dapat dihapus karena memiliki riwayat pengaduan/tindak lanjut!');
        }

        $ketuaRt->delete();

        return redirect()->route('admin.ketua_rt.index')->with('success', 'Akun Ketua RT berhasil dihapus!');
    }
}
