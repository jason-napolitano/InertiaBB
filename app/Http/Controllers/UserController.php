<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Response;
use App\Helpers\Render;

class UserController extends Controller
{
	/**
	 * Load the correct view
	 *
	 * @return \Inertia\Response
	 */
	public function index(): Response
	{
		$users = User::paginate(env('APP_DEFAULT_PAGINATION'));
		return Render::backend('users/index', [
			'users' => $users,
		]);
	}
}
