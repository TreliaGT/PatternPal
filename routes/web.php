<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatternController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PatternController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** Patterns */
    Route::get('/pattern/create', [PatternController::class, 'create'])->name('pattern.create');
    Route::post('/pattern/create', [PatternController::class, 'store'])->name('patterns.store');
    Route::get('/pattern/{pattern}/edit', [PatternController::class, 'edit'])->name('pattern.edit');
    Route::post('/pattern/{pattern}', [PatternController::class, 'update'])->name('patterns.update');
    Route::get('patterns/{pattern}', [PatternController::class, 'show'])->name('patterns.show');
    Route::post('patterns/{pattern}/delete', [PatternController::class, 'destroy'])->name('patterns.destroy');

    Route::get('profile_patterns/{user_name}', [PatternController::class, 'profile_pattern'])->name('patterns.profile_pattern');

    Route::get('category/{category}', [PatternController::class, 'showCategory'])->name('category.show');
    Route::get('tag/{tag}', [PatternController::class, 'showTag'])->name('tag.show');
    Route::get('tags', [PatternController::class, 'listTag'])->name('tag.list');
    Route::get('categories', [PatternController::class, 'listCategory'])->name('category.list');
    
    Route::get('my-patterns', [PatternController::class, 'showMyPatterns'])->name('patterns.myPatterns');
    Route::get('my-liked-patterns', [PatternController::class, 'likedPatterns'])->name('patterns.likedPatterns');

    Route::get('/pattern/search', [PatternController::class, 'search'])->name('patterns.search');

    Route::post('/patterns/{pattern}/like', [PatternController::class, 'like'])->name('patterns.like');
    Route::post('/patterns/{pattern}/unlike', [PatternController::class, 'unlike'])->name('patterns.unlike');

});

require __DIR__.'/auth.php';
