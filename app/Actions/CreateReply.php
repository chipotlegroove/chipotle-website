<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\AkismetContext;
use App\DTOs\CreateCommentData;
use App\Events\CommentPosted;
use App\Mail\CommentPostedNotification;
use App\Models\Comment;
use Illuminate\Contracts\Mail\Mailer;

final class CreateReply
{
    public function __construct(
        protected CheckIfSpam $spamChecker,
        protected Mailer $mailer,
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
            if ($comment->email) {
                $this->mailer->to($comment->email)->queue(new CommentPostedNotification($reply, isReply: true));
            }
        }

        return $reply;
    }
}
