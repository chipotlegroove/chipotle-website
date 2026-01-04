<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HasBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
class Post extends Model implements HasMedia
{
    /** @use HasBuilder<PostBuilder> */
    use HasBuilder;

    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    use InteractsWithMedia;

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

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->nonQueued()
            ->fit(Fit::Crop, 300, 250);
    }
}
