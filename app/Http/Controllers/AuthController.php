<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Model\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function ShowLogin()
    {
        return view('auth.login');
    }   

    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials['role'] = 'admin';

        if(Auth::attempt($credentials)){
            $request->session()->regenerateToken();
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'username' => 'Login Gagal, Username Salah'         
        ]);


    }

    public function ShowLoginSiswa()
    {
        return view('auth.loginsiswa');
    }

    public function loginSiswa(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        $credentials['role'] = 'siswa';

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('PageSiswa.home'); 
        }

        return back()->withErrors([
            'nisn'=>'nisn Salah, Masukan nomor nisn dengan benar'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.siswa')->with('Anda berhasil Logout');
    }   
}   