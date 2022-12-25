<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(static function () {
	// home
	Route::get('', [Controllers\CategoryController::class, 'index'])
		->name('home');
	
	// profile
	Route::get('@{user:username}', [Controllers\ProfileController::class, 'index'])
		->name('profile.index');
	
	// forums
	Route::resource('forums', Controllers\ForumController::class);
	
	Route::get('forums/{forum:uuid}', [Controllers\ForumController::class, 'show'])
		->name('forums.show');
	
	// threads
	Route::resource('threads', Controllers\ThreadController::class);
	
	Route::get('threads/{thread:uuid}', [Controllers\ThreadController::class, 'show'])
		->name('threads.show');
	
	Route::get('threads/{thread:uuid}/edit', [Controllers\ThreadController::class, 'edit'])
		->name('threads.edit');
	
	Route::get('threads/{thread:uuid}/like', [Controllers\ThreadController::class, 'like'])
		->name('threads.like');
	
	Route::get('threads/{thread:uuid}/favorite', [Controllers\ThreadController::class, 'favorite'])
		->name('threads.favorite');
	
	// replies / posts
	Route::post('threads/{thread:uuid}/reply', [Controllers\PostController::class, 'store'])
		->name('posts.store');
	
	Route::get('posts/{post:uuid}/like', [Controllers\PostController::class, 'like'])
		->name('posts.like');
	
	Route::get('posts/{post:uuid}/edit', [Controllers\PostController::class, 'like'])
		->name('posts.edit');
	
	Route::delete('posts/{post:uuid}/delete', [Controllers\PostController::class, 'destroy'])
		->name('posts.destroy');
	
	
	// categories
	Route::resource('categories', Controllers\CategoryController::class);
	
	Route::get('categories/{category:uuid}', [Controllers\CategoryController::class, 'show'])
		->name('categories.show');
	
	// dashboard
	Route::prefix('dashboard')->group(static function () {
		Route::resource('users', Controllers\UserController::class);
	});
	
	// logout
	Route::post('logout')->uses(Controllers\Auth\LogoutController::class)
		->name('logout');
});
