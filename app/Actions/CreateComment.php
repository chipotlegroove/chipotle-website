<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\AkismetContext;
use App\DTOs\CreateCommentData;
use App\Events\CommentPosted;
use App\Models\Comment;
use App\Models\Post;

final class CreateComment
{
    public function __construct(
        protected CheckIfSpam $spamChecker,
    ) {}

    public function handle(Post $post, CreateCommentData $attributes, AkismetContext $context): Comment
    {
        $isSpam = $this->spamChecker->handle($context, $attributes->body);

        $comment = $post->comments()->create([
            ...$attributes->toArray(),
            'is_spam' => $isSpam,
        ]);

        if (! $isSpam) {
            CommentPosted::dispatch($comment);
        }

        return $comment;
    }
}
