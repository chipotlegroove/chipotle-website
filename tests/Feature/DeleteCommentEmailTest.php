<?php

use App\Actions\DeleteCommentEmail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

it('deletes email from comment', function () {
    $comment = Comment::factory()
        ->for(Post::factory())
        ->withEmail()
        ->create();

    app(DeleteCommentEmail::class)->handle($comment);

    $comment->refresh();

    expect($comment->email)->toBeNull();
});

it('does not hit db when email is already null', function () {
    $comment = Comment::factory()
        ->for(Post::factory())
        ->create();

    DB::enableQueryLog();

    app(DeleteCommentEmail::class)->handle($comment);

    expect(DB::getQueryLog())->toBeEmpty();
});
