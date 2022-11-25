<?php

namespace App\Http\Controllers;

use App\Models;
use Inertia\Response;
use App\Helpers\Render;
use Illuminate\Support\Str;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Favorite;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Threads\CreateThreadRequest;
use App\Http\Requests\Threads\UpdateThreadRequest;

class ThreadController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Inertia\Response
     */
    public function show(Models\Thread $thread): Response
    {
        return Render::frontend('threads/show', [
            'favorites' => $thread->favorites ?? [],
            'likes'     => $thread->likes ?? [],
            'forum'     => $thread->forum ?? [],
            'posts'     => $thread->posts ?? [],
            'user'      => $thread->user ?? [],
            'thread'    => $thread,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $forums = Models\Forum::all();
        return Render::frontend('threads/create', [
            'forums' => $forums,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateThreadRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateThreadRequest $request): RedirectResponse
    {
        $request->validated();

        Models\Thread::create([
            'name'     => $request['name'],
            'synopsis' => $request['synopsis'],
            'content'  => $request['content'],
            'forum_id' => $request['forum_id'],
            'user_id'  => auth()->id(),
            'uuid'     => Str::uuid(),
        ]);

        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Thread created successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Inertia\Response
     */
    public function edit(Models\Thread $thread): Response
    {
        $forums = Models\Forum::all();
        return Render::frontend('threads/edit', [
            'thread' => $thread,
            'forums' => $forums,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Threads\UpdateThreadRequest $request
     * @param \App\Models\Thread                             $thread
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateThreadRequest $request, Models\Thread $thread): RedirectResponse
    {
        $request->validated();

        $thread->name = $request['name'];
        $thread->synopsis = $request['synopsis'];
        $thread->content = $request['content'];
        $thread->forum_id = $request['forum_id'];
        $thread->save();
        $thread->forum->save();

        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Thread updated successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Soft-delete the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Models\Thread $thread): RedirectResponse
    {
        // Soft delete
        $thread->delete();

        // Redirect with flash data
        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Thread deleted successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Permanently delete the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Models\Thread $thread): RedirectResponse
    {
        // Permanently delete
        $thread->forceDelete();

        // Redirect with flash data
        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Thread deleted successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Restore a permanently deleted resource from storage.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Models\Thread $thread): RedirectResponse
    {
        // Restore record
        $thread->restore();

        // Redirect with flash data
        return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
            'message' => 'Thread restored successfully',
            'context' => 'success',
        ]);
    }

    /**
     * Toggle a 'like' on and off on a thread
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function like(Models\Thread $thread): void
    {
        Like::toggle($thread, user());
    }

    /**
     * Toggle a 'like' on and off on a thread
     *
     * @param \App\Models\Thread $thread
     *
     * @return void
     */
    public function favorite(Models\Thread $thread): void
    {
        Favorite::toggle($thread, user());
    }
}
