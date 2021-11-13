<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(25);
        return view('messages.index', [
            'messages' => $messages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Message::class);
        return view('messages.create');
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
            'title' => 'required',
            'content' => 'required',
            'file' => 'required|file|max:10000' // max 10MB
        ]);
        dd("test");
        $todayDate = Carbon::now();
        $DateFormat = Carbon::parse($todayDate)->format('Y-m-d');
        $TimeFormat = Carbon::parse($todayDate)->format('H-i-s');
        $file = $request->file('file');
        $fileName =  Auth::id()."_".$DateFormat."_".$TimeFormat."_".$file->getClientOriginalName();

        $file->storeAs('public/file', $fileName);

        Message::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'file' => 'app/public/file/'.$fileName
        ]);    
        Alert::success('Berhasil', 'Pengumuman berhasil dibuat!');
        return redirect()->route('messages.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        Alert::success('Berhasil', 'Pengumuman berhasil dihapus!');
        return redirect()->route('messages.index');
    }
}
