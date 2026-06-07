<?php

use App\Actions\DeleteCommentEmail;
use App\Jobs\DeleteCommentEmail as JobsDeleteCommentEmail;
use App\Models\Comment;
use App\Models\Post;
use Psr\Log\LoggerInterface;

it('calls the action when comment exists', function () {
    $comment = Comment::factory()->for(Post::factory())->withEmail()->create();
    $action = Mockery::mock(DeleteCommentEmail::class);
    $logger = Mockery::mock(LoggerInterface::class);

    $action->expects('handle')->once();
    $logger->expects('info')->never();

    new JobsDeleteCommentEmail($comment)->handle($action, $logger);
});

it('skips action when comment deleted', function () {
    $comment = Comment::factory()->for(Post::factory())->withEmail()->create();
    $action = Mockery::mock(DeleteCommentEmail::class);
    $logger = Mockery::mock(LoggerInterface::class);

    $comment->delete();

    $action->expects('handle')->never();
    $logger->expects('info')->once();

    new JobsDeleteCommentEmail($comment)->handle($action, $logger);
});
