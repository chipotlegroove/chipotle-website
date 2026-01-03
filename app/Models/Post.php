<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HasBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/** @extends Builder<Post> */
class PostBuilder extends Builder
{
    /** @return $this */
    public function published(): static
    {
        $this->where('published', true);

        return $this;
    }
}
class Post extends Model
{
    /** @use HasBuilder<PostBuilder> */
    use HasBuilder;

    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected static string $builder = PostBuilder::class;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'description',
        'published',
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsToMany<Tag, $this> */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getUrl(): string
    {
        return route('posts.show', $this);
    }
}
