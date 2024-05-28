<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/write-article', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/write-article', [ArticleController::class, 'store'])->name('articles.store');
    Route::post('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update'); // POST instead of PUT because cannot send form data with PUT method 😞
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

require __DIR__.'/auth.php';
