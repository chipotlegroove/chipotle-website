<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentPostedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentPosted $event): void
    {
        //
    }
}
