<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rt;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role_id', 4)->get(); // 4 = Petugas
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create() 
    { 
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.petugas.create', compact('rts')); 
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users'],
            'nik'        => ['required', 'digits:16', 'unique:users'],
            'no_tlp'     => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'      => ['required', 'string', 'email:rfc', 'max:60', 'unique:users'],
            'alamat'     => ['required', 'string', 'max:100'],
            'rt_id'      => ['required', 'exists:rt,id'],
            'password'   => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'nama_warga.regex'      => 'Nama hanya boleh berisi huruf dan spasi.',
            'username.min'          => 'Username minimal 3 karakter.',
            'username.alpha_num'    => 'Username hanya boleh berisi huruf dan angka.',
            'nik.digits'            => 'NIK harus tepat 16 digit angka.',
            'no_tlp.digits_between' => 'Nomor HP harus antara 10-15 digit.',
            'no_tlp.regex'          => 'Nomor HP harus diawali angka 0.',
            'password.regex'        => 'Password harus mengandung minimal 1 huruf dan 1 angka.',
        ]);

        User::create([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'nik'        => $request->nik,
            'no_tlp'     => $request->no_tlp,
            'alamat'     => $request->alamat,
            'email'      => $request->email,
            'rt_id'      => $request->rt_id,
            'role_id'    => 4, // Petugas
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $petugas = User::where('role_id', 4)->findOrFail($id);
        return view('admin.petugas.show', compact('petugas')); 
    }
    
    public function edit($id) 
    { 
        $petugas = User::where('role_id', 4)->findOrFail($id);
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.petugas.edit', compact('petugas', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $petugas = User::where('role_id', 4)->findOrFail($id);

        $rules = [
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users,username,'.$petugas->id],
            'nik'        => ['required', 'digits:16', 'unique:users,nik,'.$petugas->id],
            'no_tlp'     => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'      => ['required', 'string', 'email:rfc', 'max:60', 'unique:users,email,'.$petugas->id],
            'alamat'     => ['required', 'string', 'max:100'],
            'rt_id'      => ['required', 'exists:rt,id'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'];
        }

        $request->validate($rules);

        $petugas->update([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'nik'        => $request->nik,
            'no_tlp'     => $request->no_tlp,
            'email'      => $request->email,
            'alamat'     => $request->alamat,
            'rt_id'      => $request->rt_id,
        ]);

        if ($request->filled('password')) {
            $petugas->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $petugas = User::where('role_id', 4)->findOrFail($id);

        if ($petugas->pengaduanDetails()->exists()) {
            return redirect()->route('admin.petugas.index')->with('error', 'Akun Petugas tidak dapat dihapus karena memiliki riwayat pengaduan/tindak lanjut!');
        }

        $petugas->delete();
        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil dihapus!');
    }

    public function resetPassword($id) 
    { 
        $petugas = User::where('role_id', 4)->findOrFail($id);
        return view('admin.petugas.reset-password', compact('petugas')); 
    }

    public function updatePassword(Request $request, $id)
    {
        $petugas = User::where('role_id', 4)->findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex'     => 'Password harus mengandung minimal 1 huruf dan 1 angka.',
        ]);

        $petugas->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password Petugas berhasil diperbarui!');
    }
}
