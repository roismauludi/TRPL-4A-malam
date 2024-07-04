<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::where('level', 'staff')->get();
        return view('admin.list', compact('users'));
    }

    public function detail($id)
    {
        $user = User::where('id_staff', $id)->get();
        // dd($user);
        return view('admin.detail', compact('user'));
    }

    public function profil()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Path ke foto pengguna di storage
        $user->foto_path = asset('storage/foto/' . $user->foto);

        return view('admin.profil', compact('user'));
    }


    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mendapatkan kredensial dari input
        $credentials = $request->only('email', 'password');

        // Melakukan percobaan login
        if (Auth::guard('web')->attempt($credentials)) {
            // Jika login berhasil, redirect ke dashboard
            return redirect()->intended('dashboard');
        }

        // Jika login gagal, kembalikan ke form login dengan error message
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'id_staff' => 'required|string|unique:users',
            'nama' => 'required',
            'password' => 'required|string|min:6',
            'email' => 'required|string|unique:users',
        ], [
            'id_staff.required' => 'No Anggota Harus Diisi.',
            'id_staff.unique' => 'No Anggota Sudah Digunakan.',
            'nama.required' => 'Nama Harus Diisi.',
            'password.required' => 'Password Harus Diisi.',
            'email.required' => 'Email Harus Diisi.',
            'email.unique' => 'Email Sudah Digunakan.',
        ]);

        if ($request->file('foto')) {
            $foto = $request->file('foto')->store('foto', 'public');
            $foto = basename($foto);
        } else {
            $foto = null;
        }

        $user = User::create([
            'id_staff' => $request->id_staff,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'foto' => $foto ?  $foto : null,
        ]);

        if ($user) {
            return redirect('/list')->with([
                'notifikasi' => 'Staff Berhasil Diregistrasi !',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Data gagal disimpan !',
                'type' => 'error'
            ]);
        }
    }

    public function editprofil($id)
    {
        $user = User::where('id_staff', $id)->first();

        if (!$user) {
            return redirect()->route('admin.list')->with('notifikasi', 'Staff tidak ditemukan')->with('type', 'error');
        }
        return view('admin.editprofil', compact('user'));
    }

    public function updateprofil(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh anggota lain.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format file foto harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran file foto maksimal 2MB.',
        ]);

        $user = User::where('id_staff', $id)->first();

        if (!$user) {
            return redirect()->route('admin.list')->with('notifikasi', 'Staff tidak ditemukan')->with('type', 'error');
        }

        // Update data anggota
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update foto jika diupload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto', 'public');
            $user->foto = basename($foto);
        }

        $user->save();

        return redirect()->route('admin.profil')->with('notifikasi', 'Data Diri berhasil diupdate')->with('type', 'success');
    }

    public function edit($id)
    {
        $user = User::where('id_staff', $id)->first();

        if (!$user) {
            return redirect()->route('admin.list')->with('notifikasi', 'Pengguna tidak ditemukan')->with('type', 'error');
        }

        return view('admin.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::where('id_staff', $id)->firstOrFail();

        // Update data user
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update foto jika diupload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto', 'public');
            $user->foto = basename($foto);
        }

        $user->save();

        return redirect()->route('admin.list')->with('status', 'Data pengguna berhasil diperbarui');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
