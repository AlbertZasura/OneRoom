<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register($role = 'student')
    {
        return view('register.register',['role'=> $role]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:4',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|numeric|unique:users',
            'status' => 'required',
            'role' => 'required',
            "identification_number" => 'required|numeric',
            "password" => 'required|min:6|confirmed',
            'password_confirmation' => 'required| min:6'
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
        Auth::login($user);
        return redirect()->route('messages.index')->with('success','register successfully.');
    }
}
