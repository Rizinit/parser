<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('article.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('article/parse', [ArticleController::class, 'parse'])->name('parse');
    Route::get('article/clean', [ArticleController::class, 'clean'])->name('clean');
    Route::get('article/{article}', [ArticleController::class, 'show'])->name('show');
});
