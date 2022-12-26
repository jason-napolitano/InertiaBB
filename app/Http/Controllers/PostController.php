<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Thread;
use Illuminate\Support\Str;
use Maize\Markable\Models\Like;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\Posts\CreatePostRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreatePostRequest $request, Thread $thread): RedirectResponse
	{
		$request->validated();
		
		Post::create([
			'name'      => $request['name'],
			'content'   => $request['content'],
			'thread_id' => $thread->id,
			'uuid'      => Str::uuid(),
			'user_id'   => auth()->id(),
		]);
		
		return back()->with([
			'message' => 'Reply Posted Successfully',
			'context' => 'success'
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\Posts\UpdatePostRequest $request
	 * @param \App\Models\Post                           $post
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdatePostRequest $request, Post $post): RedirectResponse
	{
		return back('')->with([]);
	}
	
	/**
	 * Soft-delete the specified resource from storage.
	 *
	 * @param \App\Models\Post $post
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Post $post): RedirectResponse
	{
		$post->delete();
		
		// Redirect with flash data
		return back()->with([
			'message' => 'Post deleted successfully',
			'context' => 'success',
		]);
	}
	
	/**
	 * Permanently delete the specified resource from storage.
	 *
	 * @param \App\Models\Post $post
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete(Post $post): RedirectResponse
	{
		return back('')->with([]);
	}
	
	/**
	 * Restore a permanently deleted resource from storage.
	 *
	 * @param \App\Models\Post $post
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore(Post $post): RedirectResponse
	{
		return back('')->with([]);
	}
	
	/**
	 * Toggle a 'like' on a post
	 *
	 * @param \App\Models\Post $post
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function like(Post $post): RedirectResponse
	{
		Like::toggle($post, auth()->user());
		
		// Redirect with flash data
		return back()->with([
			'message' => 'Reaction recorded',
			'context' => 'success',
		]);
	}
}
