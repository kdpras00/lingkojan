<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RukunTetangga;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller {
    
    public function index()
    {
        $petugas = User::role('petugas')->get();
        return view('admin.petugas.index', compact('petugas'));
    }
    
    public function create() 
    { 
        $rts = RukunTetangga::orderBy('nomor')->get();
        return view('admin.petugas.create', compact('rts')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_num:ascii', 'unique:users'],
            'nik'      => ['required', 'digits:16', 'unique:users'],
            'phone'    => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'    => ['required', 'string', 'email:rfc', 'max:255', 'unique:users'],
            'alamat'   => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'name.regex'      => 'Nama hanya boleh berisi huruf dan spasi.',
            'username.min'    => 'Username minimal 3 karakter.',
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka.',
            'nik.digits'      => 'NIK harus tepat 16 digit angka.',
            'phone.digits_between' => 'Nomor HP harus antara 10-15 digit.',
            'phone.regex'     => 'Nomor HP harus diawali angka 0.',
            'password.regex'  => 'Password harus mengandung minimal 1 huruf dan 1 angka.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'rt' => $request->rt,
            'rw' => '006',
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('petugas');

        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $petugas = User::role('petugas')->findOrFail($id);
        return view('admin.petugas.show', compact('petugas')); 
    }
    
    public function edit($id) 
    { 
        $petugas = User::role('petugas')->findOrFail($id);
        $rts = RukunTetangga::orderBy('nomor')->get();
        return view('admin.petugas.edit', compact('petugas', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $petugas = User::role('petugas')->findOrFail($id);

        $rules = [
            'name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_num:ascii', 'unique:users,username,'.$petugas->id],
            'nik'      => ['required', 'digits:16', 'unique:users,nik,'.$petugas->id],
            'phone'    => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'    => ['required', 'string', 'email:rfc', 'max:255', 'unique:users,email,'.$petugas->id],
            'alamat'   => ['nullable', 'string'],
        ];

        $messages = [
            'name.regex'      => 'Nama hanya boleh berisi huruf dan spasi.',
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka.',
            'nik.digits'      => 'NIK harus tepat 16 digit angka.',
            'phone.digits_between' => 'Nomor HP harus antara 10-15 digit.',
            'phone.regex'     => 'Nomor HP harus diawali angka 0.',
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'];
            $messages['password.regex'] = 'Password harus mengandung minimal 1 huruf dan 1 angka.';
        }

        $request->validate($rules, $messages);

        $petugas->name = $request->name;
        $petugas->username = $request->username;
        $petugas->nik = $request->nik;
        $petugas->phone = $request->phone;
        $petugas->email = $request->email;
        $petugas->alamat = $request->alamat;
        $petugas->rt = $request->rt;
        $petugas->rw = '006';

        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password);
        }

        $petugas->save();

        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $petugas = User::role('petugas')->findOrFail($id);
        $petugas->delete();
        return redirect()->route('admin.petugas.index')->with('success', 'Akun Petugas berhasil dihapus!');
    }

    public function resetPassword($id) 
    { 
        $petugas = User::role('petugas')->findOrFail($id);
        return view('admin.petugas.reset-password', compact('petugas')); 
    }

    public function updatePassword(Request $request, $id)
    {
        $petugas = User::role('petugas')->findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf dan 1 angka.',
        ]);

        $petugas->password = Hash::make($request->password);
        $petugas->save();

        return back()->with('success', 'Password Petugas berhasil diperbarui!');
    }
}
