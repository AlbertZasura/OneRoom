<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
class LoginController extends Controller
{

    public function login()
    {
        return view('authentications.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            if (Auth::user()->status==1){
                $request->session()->regenerate();
                return redirect()->route('home')->with('success','Berhasil masuk!');
            }else{
                Auth::logout();
                $errors="Akun anda sedang menunggu verifikasi dari Admin";
            }
        }else{
            $errors="Email dan Password salah!";
        }

        return back()->with('loginError',$errors);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Alert::warning('Berhasil', 'Akun berhasil keluar!');
        return redirect('/login');
    }
}
