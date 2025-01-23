<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function processRegister(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:5',
            'role' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama pengguna tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password harus minimal 5 karakter.',
            'role.required' => 'Role pengguna harus diisi.',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Login pengguna setelah pendaftaran
        Auth::login($user);

        // Redirect berdasarkan peran pengguna
        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }
}
