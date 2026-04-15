<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Mail\CommentPostedNotification;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentPostedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected Mailer $mailer
    ) {}

    /**
     * Handle the event.
     */
    public function handle(CommentPosted $event): void
    {
        $this->mailer->to('jaredbarojas90@gmail.com')->send(new CommentPostedNotification($event->comment));
    }
}
