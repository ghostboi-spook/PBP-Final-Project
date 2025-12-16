<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ActorFollowController;
use App\Http\Controllers\WatchlistController;

use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\ActorController as AdminActorController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing / welcome
Route::get('/', [HomeController::class, 'index'])->name('home');

// Movie detail (konten.blade)
Route::get('/konten/{movie}', [MovieController::class, 'show'])
    ->name('konten');

// Actor detail (actor.blade)
Route::get('/actor/{actor}', [ActorController::class, 'show'])
    ->name('actor.show');

// Search results
Route::get('/search', [MovieController::class, 'search'])
    ->name('search');

/*
|--------------------------------------------------------------------------
| Watchlist Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist', [WatchlistController::class, 'store'])->name('watchlist.store');
    Route::post('/watchlist/toggle/{movie}', [WatchlistController::class, 'toggle'])->name('watchlist.toggle');
    Route::get('/watchlist/{watchlist}', [WatchlistController::class, 'show'])->name('watchlist.show');
    Route::delete('/watchlist/{watchlist}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy');
}); // ✅ blok ini harus ditutup!

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'home'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/movies/{movie}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    Route::post('/actor/{actor}/follow', [ActorFollowController::class, 'toggle'])->name('actor.follow');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/movies', [AdminMovieController::class, 'index'])->name('movies.index');
        Route::get('/movies/create', [AdminMovieController::class, 'create'])->name('movies.create');
        Route::post('/movies', [AdminMovieController::class, 'store'])->name('movies.store');
        Route::get('/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('movies.edit');
        Route::put('/movies/{id}', [AdminMovieController::class, 'update'])->name('movies.update');
        Route::delete('/movies/{id}', [AdminMovieController::class, 'destroy'])->name('movies.destroy');

        Route::get('/actors', [AdminActorController::class, 'index'])->name('actors.index');
        Route::get('/actors/create', [AdminActorController::class, 'create'])->name('actors.create');
        Route::post('/actors', [AdminActorController::class, 'store'])->name('actors.store');
        Route::get('/actors/{id}/edit', [AdminActorController::class, 'edit'])->name('actors.edit');
        Route::put('/actors/{id}', [AdminActorController::class, 'update'])->name('actors.update');
        Route::delete('/actors/{id}', [AdminActorController::class, 'destroy'])->name('actors.destroy');
    });
