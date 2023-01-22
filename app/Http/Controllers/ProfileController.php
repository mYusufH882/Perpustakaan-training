<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('users.profile');
    }

    public function changePassword(Request $req, $id)
    {
        $change = [
            'password' => Hash::make($req->password)
        ];

        User::where('id', $id)->update($change);

        return redirect('/profile')->with('success', 'Password anda berhasil diubah.');
    }
}
