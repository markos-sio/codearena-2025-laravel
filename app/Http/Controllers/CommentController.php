<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->comments()->create([
            'name' => $request->input('name'),
            'body' => $request->input('body'),
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    public function delete(Post $post, Comment $comment)
    {
        
        if ($comment->post_id !== $post->id) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
