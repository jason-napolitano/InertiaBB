<?php

use App\Helpers\Traits\QueryBuilder;
use Illuminate\Contracts\Auth\Authenticatable;

// If the function doesn't exist, let's create it!
if (!function_exists('user')) {
	/**
	 * A shorthand for auth()->user()
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	function user(): ?Authenticatable
	{
		return auth()->user();
	}
}