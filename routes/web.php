<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index']);



// Display list of books
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Add book to favorites
Route::post('/books/favorites', [BookController::class, 'addToFavorites'])->name('books.addToFavorites');

// Display the favorites page
Route::get('/favorites', [BookController::class, 'showFavorites'])->name('favorites');


Route::get('/', [BookController::class, 'index'])->name('home');
Route::post('/add-to-favorites', [BookController::class, 'addToFavorites'])->name('addToFavorites');
Route::get('/favorites', [BookController::class, 'showFavorites'])->name('favorites');



