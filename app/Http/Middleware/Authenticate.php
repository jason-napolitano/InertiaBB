<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they
     * are not authenticated.
     *
     * @param $request
     *
     * @return string|void|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            session()->flash('message', 'You are not authenticated');
            session()->flash('context', 'danger');
            return route('login.index');
        }
    }
}
