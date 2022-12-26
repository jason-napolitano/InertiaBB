<?php

namespace App\Broadcasting;

use App\Models\User;

class ContentCreatedChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     *
     * @return bool
     */
    public function join(): bool
    {
		return true;
    }
}
