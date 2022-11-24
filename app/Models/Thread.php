<?php

namespace App\Models;

use Maize\Markable;
use Illuminate\Database\Eloquent;

class Thread extends Model
{
    use Eloquent\Factories\HasFactory;
    use Markable\Markable;

    protected $fillable = [
        'forum_id',
        'synopsis',
        'user_id',
        'content',
        'name',
        'uuid',
    ];

    protected static array $marks = [
        Markable\Models\Favorite::class,
        Markable\Models\Like::class,
    ];

    public function user(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function forum(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }

    public function posts(): Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }
}
