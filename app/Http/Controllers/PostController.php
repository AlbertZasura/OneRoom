<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function course()
    {
        $this->authorize('viewAny', App\Models\Post::class);
        if (Auth::user()->classes->isEmpty()) {
            return view('warnings/warningPage');
        }
        switch (Auth::user()->role) {
            case 'student':
                $courses = Course::whereHas('classes.users', function (Builder $query) {
                    $query->where('user_id', Auth::user()->id);
                })->get();
                break;
            case 'teacher':
                $courses = Course::whereHas('classes', function (Builder $query) {
                    $query->where('user_id', Auth::user()->id);
                })->get();
                break;
        }
        return view('posts.course', [
            'courses' => $courses
        ]);
    }

    public function index(Course $course)
    {
        $this->authorize('viewAny', App\Models\Post::class);
        $user = Auth::user();
        switch (Auth::user()->role) {
            case 'student':
                $courses = Course::whereHas('classes.users', function (Builder $query) use ($user) {
                    $query->where('user_id', $user->id);
                })->get();
                $classes = $user->classes;
                $posts = Post::where('course_id', $course->id)->where('class_id', $user->classes->first()->id);
                break;
            case 'teacher':
                $courses = Course::whereHas('classes', function (Builder $query) use ($user) {
                    $query->where('user_id', $user->id);
                })->get();
                $classes = $user->classCourses($course->id)->get();
                $posts = Post::where('course_id', $course->id)->whereIn('class_id', $user->classes->pluck('id'));
                if (request('class')) {
                    $posts = $posts->where('class_id', request('class'));
                } else {
                    $posts = $posts->where('class_id', $classes->first()->id);
                }
                break;
        }


        return view('posts.index', [
            'course' => $course,
            'courses' => $courses,
            'posts' => $posts->latest()->get(),
            'classes' => $classes ?? 'null'
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'attachment' => 'file|max:10000', // max 10MB
        ]);
        if (!empty($request->file('attachment'))) {
            $file = $request->file('attachment');
            $filename =  now()->format('Y-m-d-H-i-s') . "" . Auth::id() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/file', $filename);
        } else {
            $filename = '';
        }
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $filename,
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'class_id' => $request->class
        ]);
        Alert::success('Berhasil', "Forum berhasil ditambahkan!");
        return back();
    }

    public function show(Course $course, Post $post)
    {
        // $this->authorize('view', $post);
        $comments = $post->comments;
        return view('posts.show', [
            'post' => $post,
            'course' => $course,
            'comments' => $comments
        ]);
    }

    public function edit(Post $post)
    {
    }

    public function update(Request $request, Post $post)
    {
    }

    public function destroy(Course $course, Post $post)
    {
        // $this->authorize('delete', $post);
        $post->delete();
        Alert::success('Berhasil', "Forum berhasil dihapus!");
        return redirect()->route('course.posts.index', $course);
    }

    public function download(Post $post)
    {
        $pathToFile = storage_path('app\public\file\\'.$post->attachment);
        return response()->download($pathToFile);
    }
}
