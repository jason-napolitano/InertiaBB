<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LogoutController;

Route::middleware('auth')->group(static function () {
	// home
    Route::get('', [ForumController::class, 'index'])->name('home');

    // profile
    Route::get('@{user:username}', [ProfileController::class, 'index'])->name('profile.index');

    // forums
    Route::resource('forums', ForumController::class);
    Route::get('forums/{forum:uuid}', [ForumController::class, 'show'])->name('forums.show');

    // threads
    Route::resource('threads', ThreadController::class);
    Route::get('threads/{thread:uuid}', [ThreadController::class, 'show'])->name('threads.show');
    Route::get('threads/{thread:uuid}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::get('threads/{thread:uuid}/like', [ThreadController::class, 'like'])->name('threads.like');
    Route::get('threads/{thread:uuid}/favorite', [ThreadController::class, 'favorite'])->name('threads.favorite');

    // dashboard
    Route::prefix('dashboard')->group(static function () {
        Route::resource('users', UserController::class);
    });

    // logout
    Route::post('logout')->uses(LogoutController::class)->name('logout');
});
