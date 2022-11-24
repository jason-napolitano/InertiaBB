<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Inertia\Response;
use App\Http\Requests;
use App\Helpers\Render;
use Illuminate\Support\Str;
use Maize\Markable\Models\Like;
use Illuminate\Http\RedirectResponse;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        // Get all forums (paginated)
        $forums = Forum::paginate(env('APP_DEFAULT_PAGINATION'));

        // Assign `user` and `threads` data for the view
        foreach ($forums as $forum) {
	        $forum['threads'] = $forum->threads;
            $forum['user'] = $forum->user;
        }
	
	    // Render the view
        return Render::frontend('forums/index', [
            'forums' => $forums,
        ]);
    }

    /**
     * @param \App\Models\Forum $forum
     *
     * @return \Inertia\Response
     */
    public function show(Forum $forum): Response
    {
        // Get all threads in a forum (paginated)
        $threads = $forum->threads()->paginate(env('APP_DEFAULT_PAGINATION'));

        // Assign `user` and `posts` data for the view
        foreach ($threads as $thread) {
	        $thread['posts'] = $thread->posts;
            $thread['user'] = $thread->user;
        }

        // Render the view
        return Render::frontend('threads/index', [
            'threads' => $threads,
            'forum'   => $forum,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        // Render the view
        return Render::frontend('forums/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Forums\CreateForumRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\Forums\CreateForumRequest $request): RedirectResponse
    {
        // Validation
        $request->validated();

        // Model data
        Forum::create([
            'content' => $request['content'],
            'name'    => $request['name'],
            'uuid'    => Str::uuid(),
            'user_id' => auth()->id(),
        ]);

        // Redirect with flash data
        return to_route('home')->with([
            'message' => 'Thread created successfully!',
            'context' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Forum $forum
     *
     * @return \Inertia\Response
     */
    public function edit(Forum $forum): Response
    {
        // Render the view
        return Render::frontend('forums/edit', [
            'forum' => $forum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Forums\UpdateForumRequest $request
     * @param \App\Models\Forum                            $forum
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\Forums\UpdateForumRequest $request, Forum $forum): RedirectResponse
    {
        // Validation
        $request->validated();

        // Model data
        $forum->name = $request['name'];
        $forum->content = $request['content'];
        $forum->save();

        // Redirect with flash data
        return redirect()->back()->with([
            'message' => 'Record deleted successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Soft-delete the specified resource from storage.
     *
     * @param \App\Models\Forum $forum
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Forum $forum): RedirectResponse
    {
        // Soft delete
        $forum->delete();

        // Redirect with flash data
        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Record deleted successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Permanently delete the specified resource from storage.
     *
     * @param \App\Models\Forum $forum
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Forum $forum): RedirectResponse
    {
        // Permanently delete
        $forum->forceDelete();

        // Redirect with flash data
        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Record deleted successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Restore a permanently deleted resource from storage.
     *
     * @param \App\Models\Forum $forum
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Forum $forum): RedirectResponse
    {
        // Restore record
        $forum->restore();

        // Redirect with flash data
        return redirect()->back()->with([
            'message' => 'Record restored successfully',
            'context' => 'success',
        ]);
    }
	
	/**
	 * Toggle a 'like' on and off on a forum
	 *
	 * @param \App\Models\Forum $forum
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function like(Forum $forum): RedirectResponse
	{
		Like::toggle($forum, auth()->user());
		
		// Redirect with flash data
		return redirect()->back()->with([
			'message' => 'Reaction recorded',
			'context' => 'success',
		]);
	}
}
