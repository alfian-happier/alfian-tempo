<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdministratorPengguna extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('administrator.pengguna.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $users = User::orderby('created_at', 'desc')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('nomer', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })->get();

        return view('administrator.pengguna.search', compact('users', 'search'));
    }


    public function create()
    {
        return view('administrator.pengguna.create');
    }

    public function store(Request $request)
    {
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
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('administrator.pengguna.list');
    }

    public function edit($uuid)
    {
        // Ambil data berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('administrator.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $uuid)
    {
        // Ambil data pengguna berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:5',
        ], [
            'nama.required' => 'Nama pengguna tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
        ]);

        // Update data pengguna
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update role jika ada di request, jika tidak ada, gunakan role saat ini
        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        // Simpan perubahan data pengguna
        $user->save();

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('administrator.pengguna.list');
    }

    public function konfirmasi($uuid)
    {
        $user = User::all();

        // Ambil data berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Arahkan dan kirimkan datanya ke view
        return view('administrator.pengguna.konfirmasi', compact('user'));
    }

    public function destroy($uuid)
    {
        // Ambil data pengguna berdasarkan UUID
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Hapus data pengguna dari database
        $user->delete();

        return redirect()->route('administrator.pengguna.list');
    }

    public function profil()
    {
        $user = Auth::user(); // menmgambil data pengguna yang sedang login
        return view('administrator.pengguna.account-setting', compact('user'));
    }

    public function updateProfil(Request $request, $uuid)
    {
        // Ambil data pengguna berdasarkan uuid
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:5',
        ], [
            'nama.required' => 'Nama pengguna tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silahkan menggunakan email yang lain.',
        ]);

        // Update data pengguna
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        // Update role jika ada di request, jika tidak ada, gunakan role saat ini
        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        // Simpan perubahan data pengguna
        $user->save();

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('administrator.pengguna.account-setting');
    }
}
