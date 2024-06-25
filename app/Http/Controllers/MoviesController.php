<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $newMovies = Http::get("https://phimapi.com/danh-sach/phim-moi-cap-nhat?page=" . $page)->json()['items'];

        $popularMovies = Http::get("https://phimapi.com/danh-sach/phim-moi-cap-nhat?page=" . $page)->json()['items'];

        $detailMovies = collect($popularMovies)->take(5)->map(function ($movie) {
            return  Http::get("https://phimapi.com/phim/" . $movie['slug'])->json()["movie"];
        });

        return view('movies.index', [
            "newMovies" => $newMovies,
            "detailMovies" => collect($detailMovies)->take(5),
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
        $movieRaw = Http::get("https://phimapi.com/phim/" . $id)->json()["movie"];

        $status = "";

        if ($movieRaw['status'] == "completed") {
            $status = "Đã hoàn thành";
        } else {
            $status = "Đang diễn ra";
        }

        $movie = collect($movieRaw)->merge([
            "created" => explode("T", $movieRaw['created']['time'])[0],
            "modified" => explode("T", $movieRaw['modified']['time'])[0],
            "actor" => collect($movieRaw['actor'])->implode(', '),
            "director" => collect($movieRaw['director'])->implode(', '),
            "category" => collect($movieRaw['category'])->pluck('name')->implode(', '),
            "country" => collect($movieRaw['country'])->pluck('name')->implode(', '),
            "status" => $status
        ]);

        return view('movies.show', [
            "movie" => $movie
        ]);
    }

    public function play(string $id)
    {
        $episodes = Http::get("https://phimapi.com/phim/" . $id)->json()["episodes"][0]['server_data'];

        dump($episodes);

        return view('movies.play', [
            "episodes" => $episodes
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
