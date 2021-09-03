<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(3);
        return view('posts.index', [
            'posts'  => $posts,
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',

        ]);

        $request->user()->posts()->create([
            'body' => $request->body,
        ]);

        $request->session()->flash('status', 'you created a post');

        return back();
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
