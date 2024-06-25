<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    public function store(string $id)
    {
        $movie = Http::get("https://phimapi.com/phim/" . $id)->json()["movie"];

        $comment = new Comment();
        $comment->movie_id = $movie['slug'];
        $comment->user_id = Auth::id();
        $comment->content = request()->get('content');
        $comment->name = Auth::user()->name;
        $comment->save();

        return redirect()->route('movies.show', $movie['slug'])->with('success', 'Comment posted successfully');
    }
}
