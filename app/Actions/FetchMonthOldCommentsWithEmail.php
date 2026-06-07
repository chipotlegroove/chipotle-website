<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class FetchMonthOldCommentsWithEmail
{
    /** @return Collection<Comment> */
    public function handle(): Collection
    {
        $comments = Comment::query()
            ->whereNotNull('email')
            ->where('created_at', '<=', now()->subDays(30))
            ->get();

        return $comments;
    }
}
