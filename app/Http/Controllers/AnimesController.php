<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $animesRaw = Http::get('https://phimapi.com/v1/api/danh-sach/hoat-hinh?page=' . $page)->json()['data']['items'];

        $animes = collect($animesRaw)->map(function ($anime) {
            return collect($anime)->merge([
                "poster_url" =>  'https://img.phimapi.com/' . $anime['poster_url']
            ]);
        });


        $previous = $page > 1 ? $page - 1 : null;

        $next = $page < 500 ? $page + 1 : null;

        return view('animes.index', [
            "animes" => $animes,
            "previous" => $previous,
            "next" => $next

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animeRaw = Http::get("https://phimapi.com/phim/" . $id)->json()["movie"];

        $comments = Comment::with('user')->where('movie_id', $animeRaw['slug'])->get();

        // $comments = $comments->toArray();
        $comments = collect($comments)->map(function ($comment) {
            return collect($comment)->merge([
                "created_at" => Carbon::parse($comment->created_at)->format('d-m-Y')
            ]);
        });

        $comments = $comments->toArray();

        $status = "";

        if ($animeRaw['status'] == "completed") {
            $status = "Đã hoàn thành";
        } else {
            $status = "Đang diễn ra";
        }

        $anime = collect($animeRaw)->merge([
            "created" => explode("T", $animeRaw['created']['time'])[0],
            "modified" => explode("T", $animeRaw['modified']['time'])[0],
            "actor" => collect($animeRaw['actor'])->implode(', '),
            "director" => collect($animeRaw['director'])->implode(', '),
            "category" => collect($animeRaw['category'])->pluck('name')->implode(', '),
            "country" => collect($animeRaw['country'])->pluck('name')->implode(', '),
            "status" => $status
        ]);

        return view('animes.show', [
            "movie" => $anime,
            "comments" => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
