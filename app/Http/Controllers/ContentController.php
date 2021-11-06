<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Alert;

class ContentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Content::class);
        $contents = Content::all();
        return view('contents.index', [
            'contents' => $contents
        ]);
    }

    public function update(Request $request, Content $content)
    {
        $this->authorize('update',$content);
        $request->validate([
            'value' => 'required'
        ]);

        if ($content->update($request->all())){
            Alert::success('Berhasil', $content->name.' berhasil diubah!');
        }

        return redirect()->route('contents.index');
    }
}
