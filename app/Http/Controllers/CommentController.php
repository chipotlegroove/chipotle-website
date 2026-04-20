<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateComment;
use App\Actions\CreateReply;
use App\DTOs\AkismetContext;
use App\DTOs\CreateCommentData;
use App\Http\Requests\CommentPostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

final class CommentController extends Controller
{
    public function store(CommentPostRequest $request, Post $post, CreateComment $action): RedirectResponse
    {
        /** @var array{body: string} $validated */
        $validated = $request->validated();

        $comment = $action->handle($post, CreateCommentData::fromArray($validated), AkismetContext::fromRequest($request));

        $isSpam = $comment->is_spam;

        return redirect()->route('posts.show', $post->slug)->with('isSpam', $isSpam);
    }

    public function storeReply(CommentPostRequest $request, Comment $comment, CreateReply $action): RedirectResponse
    {
        /** @var array{body: string} $validated */
        $validated = $request->validated();

        $reply = $action->handle($comment, CreateCommentData::fromArray($validated), AkismetContext::fromRequest($request));

        $isSpam = $reply->is_spam;

        return redirect()->route('posts.show', $comment->post->slug)->with('isSpam', $isSpam);
    }
}
