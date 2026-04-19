<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\AkismetContext;
use App\DTOs\CreateCommentData;
use App\Events\CommentPosted;
use App\Models\Comment;

final class CreateReply
{
    public function __construct(
        protected CheckIfSpam $spamChecker
    ) {}

    public function handle(Comment $comment, CreateCommentData $attributes, AkismetContext $context): Comment
    {
        $isSpam = $this->spamChecker->handle($context, $attributes->body);

        $reply = $comment->children()->create([
            ...$attributes->toArray(),
            'post_id' => $comment->post_id,
            'is_spam' => $isSpam,
        ]);

        if (! $isSpam) {
            CommentPosted::dispatch($reply);
        }

        return $reply;
    }
}
