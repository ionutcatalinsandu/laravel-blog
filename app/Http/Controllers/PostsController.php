<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        //  $posts = $posts->all(); Asta e pentru repository;

        // return session('message');

        $posts = Post::latest()
                ->filter(request(['month', 'year']))
                ->get();

        return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {

        return view('show', compact('post'));
        
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        auth()->user()->publish($post);

        return redirect('/');
    }
}
