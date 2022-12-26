<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

class Category extends Model
{
    use Eloquent\Factories\HasFactory;
    use Eloquent\SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'user_id',
        'uuid'
    ];

    protected $hidden = [
		// ...
    ];
	
	public function user(): Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	
	public function forums(): Eloquent\Relations\HasMany
	{
		return $this->hasMany(Forum::class);
	}
}
