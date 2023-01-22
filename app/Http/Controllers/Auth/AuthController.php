<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $req)
    {
        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email/Password tidak terdaftar !!!'
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function prosesRegister(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto_profil' => 'mimes:jpg,png'
        ]);

        $data['password'] = Hash::make($req->password);

        if ($req->file('foto_profil')) {
            $path_foto_profile = $req->foto_profil->store('public/profil');
        } else {
            $path_foto_profile = "public/default.jpg";
        }

        $data['foto_profil'] = str_replace("public/profil", "", $path_foto_profile);

        User::create($data);

        return redirect('login')->with('success', 'Anda berhasil registrasi, Silahkan login !!!');
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/login');
    }
}
