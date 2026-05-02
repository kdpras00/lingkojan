<?php
namespace App\Http\Controllers\Admin;
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
        
        return view('admin.warga.index', compact('wargas', 'availableRts'));
    }
    public function create() 
    { 
        $rts = \App\Models\RukunTetangga::orderBy('nomor')->get();
        return view('admin.warga.create', compact('rts')); 
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
            'rw'       => ['required', 'string'],
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

        $user = \App\Models\User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        $user->assignRole('warga');

        return redirect()->route('admin.warga.index')->with('success', 'Akun Warga berhasil ditambahkan!');
    }
    
    public function show($id) 
    { 
        $warga = \App\Models\User::role('warga')->findOrFail($id);
        return view('admin.warga.show', compact('warga')); 
    }

    public function edit($id) 
    { 
        $warga = \App\Models\User::role('warga')->findOrFail($id);
        $rts = \App\Models\RukunTetangga::orderBy('nomor')->get();
        return view('admin.warga.edit', compact('warga', 'rts')); 
    }

    public function update(Request $request, $id)
    {
        $warga = \App\Models\User::role('warga')->findOrFail($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$warga->id],
            'nik' => ['required', 'string', 'unique:users,nik,'.$warga->id],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$warga->id],
            'rt' => ['required', 'string'],
            'rw' => ['required', 'string'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['string', 'min:8'];
        }

        $request->validate($rules);

        $warga->name = $request->name;
        $warga->username = $request->username;
        $warga->nik = $request->nik;
        $warga->alamat = $request->alamat;
        $warga->phone = $request->phone;
        $warga->email = $request->email;
        $warga->rt = $request->rt;

        if ($request->filled('password')) {
            $warga->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $warga->save();

        return redirect()->route('admin.warga.index')->with('success', 'Akun Warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $warga = \App\Models\User::role('warga')->findOrFail($id);
        $warga->delete();
        return redirect()->route('admin.warga.index')->with('success', 'Akun Warga berhasil dihapus!');
    }

    public function resetPassword($id) 
    { 
        $warga = \App\Models\User::role('warga')->findOrFail($id);
        return view('admin.warga.reset-password', compact('warga')); 
    }

    public function updatePassword(Request $request, $id)
    {
        $warga = \App\Models\User::role('warga')->findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf dan 1 angka.',
        ]);

        $warga->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $warga->save();

        return back()->with('success', 'Password Warga berhasil diperbarui!');
    }
}
