<?php

namespace App\Console\Commands;

use App\Actions\FetchMonthOldCommentsWithEmail;
use App\Jobs\DeleteCommentEmail;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:delete-comment-email')]
#[Description('Deletes email from comments older than 30 days')]
class DeleteCommentEmailCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(FetchMonthOldCommentsWithEmail $action): void
    {
        $comments = $action->handle();

        if ($comments->isNotEmpty()) {
            $this->info('Removing '.$comments->count().' emails...');
        } else {
            $this->info('No comments to remove.');

            return;
        }

        foreach ($comments as $comment) {
            DeleteCommentEmail::dispatch($comment);
        }
    }
}
