<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rt;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role_id', 1); // 1 = Warga
        if ($request->has('rt_id') && $request->rt_id != '') {
            $query->where('rt_id', $request->rt_id);
        }
        $wargas = $query->with('rt')->get();
        
        $availableRts = Rt::orderBy('nama_rt')->get();
        
        return view('admin.warga.index', compact('wargas', 'availableRts'));
    }

    public function create() 
    { 
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.warga.create', compact('rts')); 
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users'],
            'nik'        => ['required', 'digits:16', 'unique:users'],
            'no_tlp'     => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'      => ['required', 'string', 'email:rfc', 'max:60', 'unique:users'],
            'rt_id'      => ['required', 'exists:rt,id'],
            'alamat'     => ['required', 'string', 'max:100'],
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

        $user = User::create([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'nik'        => $request->nik,
            'alamat'     => $request->alamat,
            'no_tlp'     => $request->no_tlp,
            'email'      => $request->email,
            'rt_id'      => $request->rt_id,
            'role_id'    => 1, // Warga
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('admin.warga.index')->with('success', 'Akun Warga berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $warga = User::where('role_id', 1)->with('rt')->findOrFail($id);
        return view('admin.warga.show', compact('warga')); 
    }

    public function edit($id) 
    { 
        $warga = User::where('role_id', 1)->findOrFail($id);
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.warga.edit', compact('warga', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $warga = User::where('role_id', 1)->findOrFail($id);

        $rules = [
            'nama_warga' => ['required', 'string', 'max:45'],
            'username'   => ['required', 'string', 'max:45', 'unique:users,username,'.$warga->id],
            'nik'        => ['required', 'string', 'digits:16', 'unique:users,nik,'.$warga->id],
            'no_tlp'     => ['required', 'string'],
            'email'      => ['required', 'string', 'email', 'max:60', 'unique:users,email,'.$warga->id],
            'rt_id'      => ['required', 'exists:rt,id'],
            'alamat'     => ['required', 'string', 'max:100'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['string', 'min:8'];
        }

        $request->validate($rules);

        $warga->update([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'nik'        => $request->nik,
            'alamat'     => $request->alamat,
            'no_tlp'     => $request->no_tlp,
            'email'      => $request->email,
            'rt_id'      => $request->rt_id,
        ]);

        if ($request->filled('password')) {
            $warga->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.warga.index')->with('success', 'Akun Warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $warga = User::where('role_id', 1)->findOrFail($id);

        if ($warga->pengaduanDetails()->exists()) {
            return redirect()->route('admin.warga.index')->with('error', 'Akun Warga tidak dapat dihapus karena memiliki riwayat pengaduan!');
        }

        $warga->delete();
        return redirect()->route('admin.warga.index')->with('success', 'Akun Warga berhasil dihapus!');
    }

    public function resetPassword($id) 
    { 
        $warga = User::where('role_id', 1)->findOrFail($id);
        return view('admin.warga.reset-password', compact('warga')); 
    }

    public function updatePassword(Request $request, $id)
    {
        $warga = User::where('role_id', 1)->findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex'     => 'Password harus mengandung minimal 1 huruf dan 1 angka.',
        ]);

        $warga->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password Warga berhasil diperbarui!');
    }
}
