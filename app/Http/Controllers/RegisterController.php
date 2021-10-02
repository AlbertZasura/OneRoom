<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'role' => 'required',
            "identification_number" => 'required',
            "password" => 'required'
        ]);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'role' => $request->role,
            "identification_number" => $request->identification_number,
            "password" => bcrypt($request->password)
        ]);

        return redirect('/login')->with('success','register successfully.');
    }
}
