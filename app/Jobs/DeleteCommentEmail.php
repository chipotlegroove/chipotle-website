<?php

namespace App\Jobs;

use App\Actions\DeleteCommentEmail as DeleteCommentEmailAction;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Psr\Log\LoggerInterface;

class DeleteCommentEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Comment $comment,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(DeleteCommentEmailAction $action, LoggerInterface $logger): void
    {
        $comment = $this->comment->fresh();

        if ($comment === null) {
            $logger->info('comment no longer exists, skipping cleanup...');

            return;
        }

        $action->handle($this->comment);
    }
}
