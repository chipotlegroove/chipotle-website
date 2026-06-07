<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Comment;

class DeleteCommentEmail
{
    public function handle(Comment $comment): Comment
    {
        if ($comment->email) {
            $comment->email = null;

            $comment->save();
        }

        return $comment;
    }
}
