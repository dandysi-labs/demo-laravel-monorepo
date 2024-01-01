<?php

use Illuminate\Support\Facades\Route;
use App\Frontend\Http\Controllers\ArticleController;

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article}', [ArticleController::class, 'show']);
Route::get('/', function() {
    return response()->json(['data' => config('frontend.info')]);
});
