<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateComment;
use App\Actions\CreateReply;
use App\Http\Requests\CommentPostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentPostRequest $request, Post $post, CreateComment $action): RedirectResponse
    {
        $validated = $request->validated();

        $action->handle($post, $validated);

        return redirect()->back();
    }

    public function storeReply(CommentPostRequest $request, Comment $comment, CreateReply $action): RedirectResponse
    {
        $validated = $request->validated();

        $action->handle($comment, $validated);

        return redirect()->back();
    }
}
