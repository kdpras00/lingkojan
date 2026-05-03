<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RukunTetangga;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    
    public function index()
    {
        $users = User::role('admin')->get();
        return view('admin.users.index', compact('users'));
    }
    
    public function create() 
    { 
        $rts = RukunTetangga::orderBy('nomor')->get();
        return view('admin.users.create', compact('rts')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_num:ascii', 'unique:users'],
            'nik'      => ['required', 'digits:16', 'unique:users'],
            'phone'    => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'    => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'alamat'   => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'name.min'        => 'Nama minimal 3 karakter.',
            'name.regex'      => 'Nama hanya boleh berisi huruf dan spasi.',
            'username.min'    => 'Username minimal 3 karakter.',
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka (tanpa spasi/simbol).',
            'nik.digits'      => 'NIK harus tepat 16 digit angka.',
            'phone.digits_between' => 'Nomor HP harus antara 10-15 digit.',
            'phone.regex'     => 'Nomor HP harus diawali angka 0.',
            'password.min'    => 'Password minimal 8 karakter.',
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

        $user->assignRole('admin');

        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $user = User::role('admin')->findOrFail($id);
        return view('admin.users.show', compact('user')); 
    }
    
    public function edit($id) 
    { 
        $user = User::role('admin')->findOrFail($id);
        $rts = RukunTetangga::orderBy('nomor')->get();
        return view('admin.users.edit', compact('user', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $user = User::role('admin')->findOrFail($id);

        $rules = [
            'name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_num:ascii', 'unique:users,username,'.$user->id],
            'nik'      => ['required', 'digits:16', 'unique:users,nik,'.$user->id],
            'phone'    => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'    => ['required', 'string', 'email:rfc', 'max:255', 'unique:users,email,'.$user->id],
            'alamat'   => ['nullable', 'string'],
        ];

        $messages = [
            'name.min'        => 'Nama minimal 3 karakter.',
            'name.regex'      => 'Nama hanya boleh berisi huruf dan spasi.',
            'username.min'    => 'Username minimal 3 karakter.',
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

        $user->name = $request->name;
        $user->username = $request->username;
        $user->nik = $request->nik;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->rt = $request->rt;
        $user->rw = '006';

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::role('admin')->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil dihapus!');
    }
}
