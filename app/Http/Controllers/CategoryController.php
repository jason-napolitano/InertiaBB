<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Http\Requests;
use App\Helpers\Render;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
	/**
	 * @return \Inertia\Response
	 */
	public function index(): Response
	{
		$categories = Category::all();
		
		foreach ($categories as $category) {
			$category['forums'] = $category->forums()->limit(5)->get();
			$category['user'] = $category->user;
		}
		
		return Render::frontend('categories/index', [
			'categories' => $categories,
		]);
	}
	
	/**
	 * @param \App\Models\Category $category
	 *
	 * @return \Inertia\Response
	 */
	public function show(Category $category): Response
	{
		$forums = $category->forums()->paginate(env('APP_DEFAULT_PAGINATION'));
		
		foreach ($forums as $forum) {
			$forum['category'] = $forum->category;
			$forum['threads'] = $forum->threads;
			$forum['user'] = $forum->user;
		}
		
		return Render::frontend('forums/index', [
			'forums'   => $forums,
			'category' => $category,
		]);
	}
	
	/**
	 * @return \Inertia\Response
	 */
	public function create(): Response
	{
		return Render::frontend('categories/create');
	}
	
	/**
	 * @param \App\Http\Requests\Categories\CreateCategoryRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Requests\Categories\CreateCategoryRequest $request): RedirectResponse
	{
		// Validation
		$request->validated();
		
		// Model data
		$category = Category::create([
			'content' => $request['content'],
			'name'    => $request['name'],
			'uuid'    => Str::uuid(),
			'user_id' => auth()->id(),
		]);
		
		// Redirect with flash data
		return to_route('categories.show', $category)->with([
			'message' => 'Category created successfully!',
			'context' => 'success',
		]);
	}
	
	/**
	 * Soft-delete the specified resource from storage.
	 *
	 * @param \App\Models\Category $category
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Category $category): RedirectResponse
	{
		// Soft delete
		$category->delete();
		
		// Redirect with flash data
		return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
			'message' => 'Record deleted successfully',
			'context' => 'success',
		]);
	}
	
	/**
	 * Permanently delete the specified resource from storage.
	 *
	 * @param \App\Models\Category $category
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete(Category $category): RedirectResponse
	{
		// Permanently delete
		$category->forceDelete();
		
		// Redirect with flash data
		return to_route(\App\Providers\RouteServiceProvider::HOME)->with([
			'message' => 'Record deleted successfully',
			'context' => 'success',
		]);
	}
	
	/**
	 * Restore a permanently deleted resource from storage.
	 *
	 * @param \App\Models\Category $category
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore(Category $category): RedirectResponse
	{
		// Restore record
		$category->restore();
		
		// Redirect with flash data
		return back()->with([
			'message' => 'Record restored successfully',
			'context' => 'success',
		]);
	}
}
