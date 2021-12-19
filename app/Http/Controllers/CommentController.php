<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Alert;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request, Post $post)
    {
        // $this->authorize('create', App\Models\Assignment::class);
        $request->validate([
            'description' => 'required',
            'attachment' => 'file|max:10000', // max 10MB
        ]);
        if(!empty($request->file('attachment'))){
            $file = $request->file('attachment');
            $filename =  now()->format('Y-m-d-H-i-s')."".Auth::id()."_".$file->getClientOriginalName();
            $file->storeAs('public/file', $filename);
        }else{
            $filename='';
        }
        Comment::create([
                'description' => $request->description,
                'attachment' => $filename,
                'user_id' =>Auth::id(),
                'post_id' => $post->id
            ]);
        Alert::success('Berhasil', "Komentar berhasil ditambahkan!");
        return back();
    }

    public function show(Comment $comment)
    {
    }

    public function edit(Comment $comment)
    {
    }

    public function update(Request $request, Comment $comment)
    {
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        Alert::success('Berhasil', "Komentar berhasil dihapus!");
        return back();
    }

    public function download(Comment $comment)
    {
        $pathToFile = storage_path('app/public/file/'.$comment->attachment);
        return response()->download($pathToFile);
    }
}
