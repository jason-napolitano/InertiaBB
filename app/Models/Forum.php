<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

/**
 * @method static paginate(int $n)
 */
class Forum extends Model
{
    use Eloquent\Factories\HasFactory;
    use Eloquent\SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'user_id',
        'category_id',
        'uuid',
    ];

    public function category(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function threads(): Eloquent\Relations\HasMany
    {
        return $this->hasMany(Thread::class);
    }
}
