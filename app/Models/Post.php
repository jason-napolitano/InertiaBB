<?php

namespace App\Models;

use Maize\Markable;
use Illuminate\Database\Eloquent;

class Post extends Eloquent\Model
{
    use Eloquent\Factories\HasFactory;
    use Markable\Markable;

    protected static array $marks = [
        Markable\Models\Like::class,
    ];

    public function user(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function thread(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }
}
