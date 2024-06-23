<?php

use App\Http\Controllers\AnimesController;
use App\Http\Controllers\FeatureMoviesController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

//Home Page
Route::get('/{page?}', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/play/{movie}', [MoviesController::class, 'play'])->name('movies.play');

//Feature Movies
Route::get('/feature-movies/page/{page?}', [FeatureMoviesController::class, 'index'])->name('feature-movies.index');
Route::get('/feature-movies/{movie}', [FeatureMoviesController::class, 'show'])->name('feature-movies.show');

//Series Movie
Route::get('/series/page/{page?}', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/{movie}', [SeriesController::class, 'show'])->name('series.show');

//Animes
Route::get('/animes/page/{page?}', [AnimesController::class, 'index'])->name('animes.index');
Route::get('/animes/{movie}', [AnimesController::class, 'show'])->name('animes.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
