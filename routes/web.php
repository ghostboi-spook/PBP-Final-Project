<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// halaman lain
Route::view('/login', 'login');
Route::view('/actor', 'actor');
Route::view('/search', 'search');
Route::view('/watchlist', 'watchlist');
