<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function processLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return back()->withErrors(['error' => 'Email atau password salah']);
        }

        $user = Auth::user();

        switch ($user->role) {
            case 'Administrator':
                return redirect()->route('administrator.dashboard');
            case 'User':
                return redirect()->route('user.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akun tidak diketahui. Silakan hubungi Administrator.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
