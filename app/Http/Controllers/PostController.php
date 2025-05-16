<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(?User $user = null)
    {
        $posts = Post::query()
        ->whereNotNull('image')
        ->whereNotNull('published_at') 
        ->when($user, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
                         
        })
        ->orderBy('promoted','desc') 
        ->orderBy('published_at', 'desc')
        ->paginate(9);

        $authors = User::whereHas('posts', function ($query) {
        $query->whereNotNull('published_at')->whereNotNull('image');
        })->get();

        

        return view('posts.index', compact('posts', 'authors'));
    }

    public function show(Post $post)
    {
        if (is_null($post->published_at)) {
        abort(404);
    }
        $comments = $post->comments()->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function promoted()
    {
        $posts = Post::query()
        ->where('promoted', true)
        ->whereNotNull('image')
        ->whereNotNull('published_at')
        ->orderBy('published_at', 'desc')
        ->paginate(9);
        
        $authors = User::whereHas('posts', function ($query) {
        $query->whereNotNull('published_at')->whereNotNull('image');
        })->get();

        return view('posts.index', compact('posts','authors'));
    }

}
