<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 5)->get(); // 5 = Admin
        return view('admin.users.index', compact('users'));
    }

    public function create() 
    { 
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.users.create', compact('rts')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users'],
            'nik'        => ['required', 'digits:16', 'unique:users'],
            'no_tlp'     => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'      => ['required', 'string', 'email:rfc,dns', 'max:60', 'unique:users'],
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
            'role_id'    => 5, // Admin
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $user = User::where('role_id', 5)->findOrFail($id);
        return view('admin.users.show', compact('user')); 
    }
    
    public function edit($id) 
    { 
        $user = User::where('role_id', 5)->findOrFail($id);
        $rts = Rt::orderBy('nama_rt')->get();
        return view('admin.users.edit', compact('user', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role_id', 5)->findOrFail($id);

        $rules = [
            'nama_warga' => ['required', 'string', 'min:3', 'max:45', 'regex:/^[\p{L}\s]+$/u'],
            'username'   => ['required', 'string', 'min:3', 'max:45', 'alpha_num:ascii', 'unique:users,username,'.$user->id],
            'nik'        => ['required', 'digits:16', 'unique:users,nik,'.$user->id],
            'no_tlp'     => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'      => ['required', 'string', 'email:rfc', 'max:60', 'unique:users,email,'.$user->id],
            'alamat'     => ['required', 'string', 'max:100'],
            'rt_id'      => ['required', 'exists:rt,id'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'];
        }

        $request->validate($rules);

        $user->update([
            'nama_warga' => $request->nama_warga,
            'username'   => $request->username,
            'nik'        => $request->nik,
            'no_tlp'     => $request->no_tlp,
            'email'      => $request->email,
            'alamat'     => $request->alamat,
            'rt_id'      => $request->rt_id,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::where('role_id', 5)->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil dihapus!');
    }
}
