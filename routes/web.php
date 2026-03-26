<?php

use App\Models\Gare;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/gares', function () {
    return response()->json(Gare::all());
});

Route::get('/api/trains', function () {
    return response()->json(App\Models\Train::all());
});
