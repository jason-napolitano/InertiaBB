<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Response;
use App\Helpers\Render;

class ProfileController extends Controller
{
    /**
     * Controller entry-point
     *
     * @param \App\Models\User $user
     *
     * @return \Inertia\Response
     */
    public function index(User $user): Response
    {
        return Render::frontend('profile/index', [
            'profile' => $user,
            'threads' => $user->threads()->limit(5)->orderByDesc('id')->get(),
            'forums'  => $user->forums()->limit(5)->orderByDesc('id')->get(),
            'posts'   => $user->posts()->limit(5)->orderByDesc('id')->get(),
        ]);
    }
}
