<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\User;
use Illuminate\Contracts\Auth\guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        // $user = auth()->user();\
        $user = Auth::guard('dokter')->user() ?? Auth::user();
        // dd($user);

        return view('admin.profile.index', compact('user'));
    }


    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::guard('dokter')->user() ?? Auth::user();

        return view('admin.profile.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = Auth::guard('dokter')->user() ?? Auth::user();

        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'gambar_user' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_password' => 'nullable', // Add this line
            'new_password' => 'nullable|min:8', // Change to nullable
            'confirm_password' => 'nullable|same:new_password',
        ]);

        // Handle image uploads
        if ($request->hasFile('gambar_user')) {
            $gambar = $request->file('gambar_user');
            $name = time() . '.' . $gambar->getClientOriginalExtension();
            $destinationPath = public_path('img');
            $gambar->move($destinationPath, $name);

            // Delete previous image
            File::delete(public_path('img/' . ($user->gambar_user ?? $user->gambar_dokter)));

            $validatedData['gambar_user'] = $name;

            session(['gmbr' => $name]);
        }

        // Update user data based on guard
        if (Auth::guard('dokter')->check()) {
            Dokter::where('id', $id)->update([
                'nama_dokter' => $validatedData['name'],
                'email' => $validatedData['email'],
                'no_hp' => $validatedData['no_hp'],
                'gambar_dokter' => isset($validatedData['gambar_user']) ? $validatedData['gambar_user'] : $user->gambar_dokter

                // Update other fields for the 'dokter' model
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'no_hp' => $validatedData['no_hp'],
                 'gambar_user' => isset($validatedData['gambar_user']) ? $validatedData['gambar_user'] : $user->gambar_user
                // Update other fields for the 'user' model
            ]);
        }

        if ($request->filled('new_password')) {
            $profile = Auth::guard('dokter')->user() ?? Auth::user();

            if (Hash::check($request->current_password, $profile->password)) {
                // Check if new_password and confirm_password match
                if ($request->new_password === $request->confirm_password) {
                    $profile->password = Hash::make($request->new_password);
                    $profile->save();
                } else {
                    return redirect()->back()->withErrors(['confirm_password' => 'New password and confirm password do not match.']);
                }
            } else {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        }

        return redirect('/profile')->with('success', 'Data berhasil diupdate');
    }
}
