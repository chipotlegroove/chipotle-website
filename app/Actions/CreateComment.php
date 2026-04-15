<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\CommentPosted;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

final class CreateComment
{
    /** @param array<string, mixed> $attributes */
    public function handle(Post $post, array $attributes): Comment
    {

        $comment = DB::transaction(function () use ($attributes, $post) {
            $comment = $post->comments()->create($attributes);

            return $comment;
        });

        CommentPosted::dispatch($comment);

        return $comment;
    }
}
