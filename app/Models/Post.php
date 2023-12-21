<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    const STATUS_UNAPPROVED = 1;
    const STATUS_APPROVED = 2;

    const MAX_RELATED_POSTS = 3;

    const LIMIT_BLOG_PAGE = 6;
    const LIMIT_BLOG_PROFILE = 1;

    protected $table = "posts";
    
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comments', 'post_id', 'user_id');
    }
}
