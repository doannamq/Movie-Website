<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $seriesRaw = Http::get('https://phimapi.com/v1/api/danh-sach/phim-bo?page=' . $page)->json()['data']['items'];

        $series = collect($seriesRaw)->map(function ($serie) {
            return collect($serie)->merge([
                "poster_url" =>  'https://img.phimapi.com/' . $serie['poster_url']
            ]);
        });


        $previous = $page > 1 ? $page - 1 : null;

        $next = $page < 500 ? $page + 1 : null;

        return view('series.index', [
            "series" => $series,
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
        $serieRaw = Http::get("https://phimapi.com/phim/" . $id)->json()["movie"];

        $comments = Comment::with('user')->where('movie_id', $serieRaw['slug'])->get();

        // $comments = $comments->toArray();
        $comments = collect($comments)->map(function ($comment) {
            return collect($comment)->merge([
                "created_at" => Carbon::parse($comment->created_at)->format('d-m-Y')
            ]);
        });

        $comments = $comments->toArray();

        $status = "";

        if ($serieRaw['status'] == "completed") {
            $status = "Đã hoàn thành";
        } else {
            $status = "Đang diễn ra";
        }

        $serie = collect($serieRaw)->merge([
            "created" => explode("T", $serieRaw['created']['time'])[0],
            "modified" => explode("T", $serieRaw['modified']['time'])[0],
            "actor" => collect($serieRaw['actor'])->implode(', '),
            "director" => collect($serieRaw['director'])->implode(', '),
            "category" => collect($serieRaw['category'])->pluck('name')->implode(', '),
            "country" => collect($serieRaw['country'])->pluck('name')->implode(', '),
            "status" => $status
        ]);

        return view('series.show', [
            "movie" => $serie,
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
