<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

Route::resource('/article', Controllers\ArticleController::class);
Route::get('/articles/{user}', [Controllers\UserArticlesController::class, 'index'])->name('article.userArticles');
Route::post('/comments/{article}', [Controllers\CommentsController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [Controllers\CommentsController::class, 'destroy'])->name('comments.destroy');

Route::get('/profile', [Controllers\UserProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [Controllers\UserProfileController::class, 'update'])->name('profile.update');

Route::get('/contact', [Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [Controllers\ContactController::class, 'store']);
