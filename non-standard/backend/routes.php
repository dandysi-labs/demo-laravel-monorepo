<?php

use Backend\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return response()->json(['data' => config('backend.info')]);
});
Route::post('/articles', [ArticleController::class, 'create']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article}', [ArticleController::class, 'show']);
Route::delete('/articles/{article}', [ArticleController::class, 'delete']);
Route::patch('/articles/{article}/submit', [ArticleController::class, 'submit']);
Route::patch('/articles/{article}/publish', [ArticleController::class, 'publish']);
Route::patch('/articles/{article}/reject', [ArticleController::class, 'reject']);
