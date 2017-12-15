<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;
use Illuminate\Support\Carbon;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Post $posts)
    {
        // $posts = Post::latest();

        // if($month = request('month')){
        //     $posts->whereMonth('created_at', Carbon::parse($month)->month);
        // }
        // if($year = request('year')){
        //     $posts->whereYear('created_at', $year);
        // }

        // $posts = $posts->get();

        // $posts = Post::latest()
        //     ->filter(request(['month','year']))
        //     ->get();

        $posts = $posts->all();

        // $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        //     ->groupBy('year', 'month')
        //     ->orderByRaw('min(created_at) desc')
        //     ->get()
        //     ->toArray();

        //$archives = Post::archives();

        // return view('posts.index', compact('posts', 'archives'));
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        //$post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //dd(request()->all());

        //$post = new Post;
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->save();

        // Post::create([
        //     'title' => request('title'),
        //     'body' => request('body')
        // ]);

        $this->validate(request(),[
            'title' => 'required',
            'body' => 'required|min:10'
        ]);

        //Post::create([request(['title', 'body'])]);
        // Post::create([
        //     'title' => request('title'),
        //     'body' => request('body'),
        //     'user_id' => auth()->id()
        // ]);
        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        session()->flash('message', 'Your post has now been published');

        return redirect('/');
    }
}
