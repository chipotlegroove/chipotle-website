<?php

declare(strict_types=1);

namespace App\Actions;

use App\Events\CommentPosted;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

final class CreateReply
{
    /** @param array<string, mixed> $attributes */
    public function handle(Comment $comment, array $attributes): Comment
    {
        $attributes['post_id'] = $comment->post_id;

        $reply = DB::transaction(function () use ($comment, $attributes) {
            $reply = $comment->children()->create($attributes);

            return $reply;
        });

        CommentPosted::dispatch($reply);

        return $reply;
    }
}
