<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeatureMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $featureMoviesRaw = Http::get('https://phimapi.com/v1/api/danh-sach/phim-le?page=' . $page)->json()['data']['items'];

        $featureMovies = collect($featureMoviesRaw)->map(function ($featureMovie) {
            return collect($featureMovie)->merge([
                "poster_url" =>  'https://img.phimapi.com/' . $featureMovie['poster_url']
            ]);
        });


        $previous = $page > 1 ? $page - 1 : null;

        $next = $page < 500 ? $page + 1 : null;

        return view('feature-movies.index', [
            "featureMovies" => $featureMovies,
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
        $featureMovieRaw = Http::get("https://phimapi.com/phim/" . $id)->json()["movie"];

        $status = "";

        if ($featureMovieRaw['status'] == "completed") {
            $status = "Đã hoàn thành";
        } else {
            $status = "Đang diễn ra";
        }

        $featureMovie = collect($featureMovieRaw)->merge([
            "created" => explode("T", $featureMovieRaw['created']['time'])[0],
            "modified" => explode("T", $featureMovieRaw['modified']['time'])[0],
            "actor" => collect($featureMovieRaw['actor'])->implode(', '),
            "director" => collect($featureMovieRaw['director'])->implode(', '),
            "category" => collect($featureMovieRaw['category'])->pluck('name')->implode(', '),
            "country" => collect($featureMovieRaw['country'])->pluck('name')->implode(', '),
            "status" => $status
        ]);

        return view('feature-movies.show', [
            "featureMovie" => $featureMovie
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
