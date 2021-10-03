<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function register($role = 'student')
    {
        if (!in_array($role,["student","teacher","admin"])) {
            $role="student"; 
        }
        return view('authentications.register',['role'=> $role]);
    }

    public function store(Request $request)
    {
        switch ($request->role) {
            case 'admin':
                $role_id=0;
                break;
            case 'teacher':
                $role_id=1;
                break;
            default:
                $role_id=2;
                break;
        }
        $request->validate([
            'name' => 'required|max:255|min:4',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|numeric|unique:users',
            'status' => 'required|numeric',
            'role' => 'required',
            "identification_number" => $request->role==="admin" ? '':'required|numeric',
            "password" => 'required|min:6|confirmed',
            'password_confirmation' => 'required| min:6'
        ]);
        // dd($request);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'role' => $role_id,
            "identification_number" => $request->role==="admin" ? "0":$request->identification_number,
            "password" => bcrypt($request->password)
        ]);
        Auth::login($user);
        return redirect()->route('messages.index')->with('success','register successfully.');
    }
}
