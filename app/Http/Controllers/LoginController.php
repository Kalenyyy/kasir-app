<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function loginAuth(Request $request)
    {
        //validasi
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //ambil value dari input dan simpan sebuah variable
        $user = $request->only(['email', 'password']);

        if (Auth::attempt($user)) {
            return redirect()->route('dashboard')->with('Success', 'Selamat Datang ' . Auth::user()->name);
        } else {
            return redirect()->back()->with('failed', 'Username dan Password tidak sesuai. Silahkan coba lagi');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
