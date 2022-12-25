<?php

namespace App\Models;

use Maize\Markable;
use Illuminate\Database\Eloquent;

class Post extends Model
{
    use Eloquent\Factories\HasFactory;
	use Eloquent\SoftDeletes;
    use Markable\Markable;
	
	protected $fillable = [
		'name',
		'content',
		'user_id',
		'uuid',
		'thread_id'
	];

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
