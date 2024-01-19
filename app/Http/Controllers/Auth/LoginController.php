<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('dokter')->attempt($credentials)) {
            $request->session()->regenerate();
            $dokter = Auth::guard('dokter')->user();
            session(['nama' => $dokter->nama_dokter]);
            session(['gmbr' => $dokter->gambar_dokter]);
            return redirect('/dashboard')->with('success', 'Anda Berhasil Login');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Check the user's role here and redirect accordingly
            if ($user->role === 'pasien') {
                return redirect()->route('dashboard-pasien')->with('success', 'Anda Berhasil Login');
            }

            session(['nama' => $user->name]);
            session(['gmbr' => $user->gambar_user]);
            return redirect('/dashboard')->with('success', 'Anda Berhasil Login');
        }

        return back()->withErrors([
            'email' => 'Email atau Password Anda Salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/halaman-awal');
    }

    public function registrasi()
    {
        return view('register');
    }

    public function simpanRegistrasi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|exists:pasiens,nik',
            'gambar_user' => 'required|image|mimes:jpeg,png,jpg,gif',
            'no_hp' => 'required|numeric',
            'posisi' => 'required',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $foto_file = $request->file('gambar_user');
        $foto_ekstensi = $foto_file->getClientOriginalExtension();
        $nama_foto = time() . '.' . $foto_ekstensi;
        $foto_file->move(public_path('img'), $nama_foto);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gambar_user' => $nama_foto,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'posisi' => $request->posisi,
            'password' => Hash::make($request->password),
        ];
        User::create($data);

        return redirect('/login')->with('success', 'Data User berhasil di Tambah');
    }
}
