<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Alert;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', App\Models\User::class);
        $users = User::where('status', 0);

        if(request('search')){
            $users = User::latest()->where('name', 'like', '%' . request('search') .'%');
        }

        return view('Accounts.index', [
            'users' => $users->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);
        
        User::create([
            'user_id' => Auth::user()->id,
            'status' => $request->status
        ]);

        return redirect()->route('users.index')->with('success','Message created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)   
    {
        $users = Auth::user();
        return view('profiles.edit', [
            'users' => $users
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('viewAny', App\Models\User::class);
        $user->update([
            'user_id' => Auth::user()->id,
            'status' => "1"
        ]);

        Alert::warning('Berhasil', 'Pengguna berhasil diterima!');
        return redirect()->route('users.index');
    }

    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255|min:4',
            'identification_number' => $request->role==="admin" ? '':'required|numeric',
            'phone' => "required|numeric|unique:users,phone,$user->id",
            'email' => "required|email|unique:users,email,$user->id",
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required| min:6'
        ]);

        $user->update([
            'name' => $request->name,
            'identification_number' => $request->role==="admin" ? "0":$request->identification_number,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Alert::warning('Berhasil', 'Profil berhasil diubah!');
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->update([
            'user_id' => Auth::user()->id,
            'status' => "2"
        ]);

        Alert::warning('Berhasil', 'Pengguna berhasil ditolak!');
        return back(); 
    }

    //update user profile image
    public function profileImageUpdate(Request $request){
        $user_id = $request->user_id;
        $user = User::find($user_id);

        if($request->hasFile('profile_picture')){
            $file = $request->file('profile_picture');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/images/', $fileName);

            //cek kalau udah ada profile pict
            if($user->profile_picture){
                Storage::delete('public/images/'.$user->profile_picture);
            }
            
        }
        User::where('id', $user_id)->update([
            'profile_picture' => $fileName
        ]);

        return response()->json([
            'messages' => 'Gambar Profil berhasil'
        ]);
    }
}
