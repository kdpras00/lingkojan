<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('warga')) {
                return redirect()->route('warga.dashboard');
            } elseif ($user->hasRole('petugas')) {
                return redirect()->route('petugas.dashboard');
            } elseif ($user->hasRole('rt')) {
                return redirect()->route('rt.dashboard');
            } elseif ($user->hasRole('rw')) {
                return redirect()->route('rw.dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password yang Anda masukkan salah.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.max' => 'Nama maksimal 50 karakter.',
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_num' => 'Username hanya boleh huruf dan angka tanpa spasi.',
            
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            
            'phone.required' => 'Nomor Telepon tidak boleh kosong.',
            'phone.regex' => 'Nomor HP tidak valid (harus angka, 10-13 digit, diawali 08).',
            
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid (harus mengandung @ dan domain).',
            'email.unique' => 'Email sudah terdaftar.',
            
            'rt.required' => 'RT harus dipilih.',
            'rt.in' => 'Pilihan RT tidak valid.',
            
            'rw.required' => 'RW harus dipilih.',
            'rw.in' => 'Pilihan RW tidak valid.',
            
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung kombinasi huruf dan angka.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'username' => ['required', 'string', 'max:50', 'alpha_num', 'unique:users'],
            'nik' => ['required', 'digits:16', 'unique:users'],
            'phone' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'rt' => ['required', 'string', 'in:001,002,003,004,005,006,007,008,009,010,011,012,013,014,015,016'],
            'rw' => ['required', 'string', 'in:006'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'confirmed'],
        ], $messages);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'email' => $request->email,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        $user->assignRole('warga');

        Auth::login($user);

        return redirect()->route('warga.dashboard');
    }
}
