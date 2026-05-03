<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KetuaRTController extends Controller {
    
    public function index()
    {
        $ketuaRts = User::role('rt')->get();
        return view('admin.ketua_rt.index', compact('ketuaRts'));
    }
    
    public function create() 
    { 
        $rts = \App\Models\RukunTetangga::orderBy('nomor')->get();
        return view('admin.ketua_rt.create', compact('rts')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_num:ascii', 'unique:users'],
            'nik'      => ['required', 'digits:16', 'unique:users'],
            'phone'    => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'    => ['required', 'string', 'email:rfc', 'max:255', 'unique:users'],
            'rt'       => ['required', 'string'],
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

        $user->assignRole('rt');

        // Sync with Master RT table
        \App\Models\RukunTetangga::where('nomor', $request->rt)->update(['nama_ketua' => $request->name]);

        return redirect()->route('admin.ketua_rt.index')->with('success', 'Akun Ketua RT berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $ketuaRt = User::role('rt')->findOrFail($id);
        return view('admin.ketua_rt.show', compact('ketuaRt')); 
    }
    
    public function edit($id) 
    { 
        $ketuaRt = User::role('rt')->findOrFail($id);
        $rts = \App\Models\RukunTetangga::orderBy('nomor')->get();
        return view('admin.ketua_rt.edit', compact('ketuaRt', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $ketuaRt = User::role('rt')->findOrFail($id);

        $rules = [
            'name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_num:ascii', 'unique:users,username,'.$ketuaRt->id],
            'nik'      => ['required', 'digits:16', 'unique:users,nik,'.$ketuaRt->id],
            'phone'    => ['required', 'digits_between:10,15', 'regex:/^0[0-9]+$/'],
            'email'    => ['required', 'string', 'email:rfc', 'max:255', 'unique:users,email,'.$ketuaRt->id],
            'rt'       => ['required', 'string'],
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

        $oldRt = $ketuaRt->rt;

        $ketuaRt->name = $request->name;
        $ketuaRt->username = $request->username;
        $ketuaRt->nik = $request->nik;
        $ketuaRt->phone = $request->phone;
        $ketuaRt->email = $request->email;
        $ketuaRt->alamat = $request->alamat;
        $ketuaRt->rt = $request->rt;
        $ketuaRt->rw = '006';

        if ($request->filled('password')) {
            $ketuaRt->password = Hash::make($request->password);
        }

        $ketuaRt->save();

        // Sync with Master RT table
        if ($oldRt !== $request->rt) {
            \App\Models\RukunTetangga::where('nomor', $oldRt)->update(['nama_ketua' => null]);
        }
        \App\Models\RukunTetangga::where('nomor', $request->rt)->update(['nama_ketua' => $request->name]);

        return redirect()->route('admin.ketua_rt.index')->with('success', 'Akun Ketua RT berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ketuaRt = User::role('rt')->findOrFail($id);
        $oldRt = $ketuaRt->rt;
        
        $ketuaRt->delete();

        // Sync with Master RT table
        \App\Models\RukunTetangga::where('nomor', $oldRt)->update(['nama_ketua' => null]);

        return redirect()->route('admin.ketua_rt.index')->with('success', 'Akun Ketua RT berhasil dihapus!');
    }
}
