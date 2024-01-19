<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%$search%")->simplePaginate(10);

        return view('admin.user.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'gambar_user' => 'required|image|mimes:jpeg,png,jpg,gif',
            'no_hp' => 'required|numeric',
            'posisi' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Nama User harus diisi.',
            'gambar_user.required' => 'Gambar User harus diisi.',
            'gambar_user.image' => 'File yang diupload harus berupa gambar.',
            'gambar_user.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, gif, atau svg.',
            'posisi.required' => 'Jenis kelamin harus diisi.',
            'role.required' => 'Umur harus diisi.',
            'no_hp.required' => 'No HP harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
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
            'posisi' => $request->posisi,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ];

        User::create($data);
        return redirect('/user')->with('success', 'Data User berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'posisi' => 'required',
            'role' => 'required',
        ]);

        if ($request->hasFile('gambar_user')) {
            $gambar = $request->file('gambar_user');
            $name = time() . '.' . $gambar->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $gambar->move($destinationPath, $name);

            $data_gambar = User::findOrFail($id);
            File::delete(public_path('img/' . $data_gambar->gambar_user));

            $validatedData['gambar_user'] = $name;
        }

        User::where('id', $id)->update($validatedData);

        return redirect('/user')->with('success', 'Data User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(User $user)
    {
        // Inisialisasi pesan
        $message = 'Data berhasil Dihapus';

        // Periksa apakah user yang akan dihapus adalah superadmin
        if ($user->role === 'superadmin') {
            $message = 'Anda tidak dapat menghapus superadmin sendiri.';
            FacadesAlert::error('Error', $message);
        } else {
            // Jika bukan superadmin, lakukan penghapusan
            User::destroy($user->id);
            FacadesAlert::success('Success', $message);
        }

        return redirect('/user');
    }



    public function register(Request $request)
    {
        
        return view('register');
    }

    /**
     * Store a newly registered user in storage.
     */
    public function postRegister(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'gambar_user' => 'required|image|mimes:jpeg,png,jpg,gif',
            'no_hp' => 'required|numeric',
            'password' => 'required|min:6', // Add minimum password length constraint.
            'role' => 'required',
        ], [
            'name.required' => 'Nama User harus diisi.',
            'gambar_user.required' => 'Gambar User harus diisi.',
            'gambar_user.image' => 'File yang diupload harus berupa gambar.',
            'gambar_user.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, gif, atau svg.',
            'posisi.required' => 'Jenis kelamin harus diisi.',
            'role.required' => 'Umur harus diisi.',
            'no_hp.required' => 'No HP harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
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
            'posisi' => $request->posisi,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ];

        User::create($data);
        return redirect('/login')->with('success', 'Data User berhasil di Tambah');
    }
    
}
