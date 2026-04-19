<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

final class Comment extends Model
{
    use HasRecursiveRelationships;

    protected $with = [
        'children',
        'post',
    ];

    protected $fillable = [
        'email',
        'is_spam',
        'body',
        'post_id',
        'parent_id',
    ];

    /** @return BelongsTo<Post, $this> */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
