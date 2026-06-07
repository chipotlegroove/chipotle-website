<?php

use App\Jobs\DeleteCommentEmail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Queue;

use function Pest\Laravel\artisan;

it('dispatches a job for every comment with deleteable email', function () {
    Queue::fake([
        DeleteCommentEmail::class,
    ]);

    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => now()->subDays(30),
        ])
        ->withEmail()
        ->create();

    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => now()->subDays(30),
        ])
        ->create();

    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => now(),
        ])
        ->withEmail()
        ->create();

    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => now(),
        ])
        ->create();

    artisan('app:delete-comment-email');

    Queue::assertPushedTimes(DeleteCommentEmail::class, 1);
});

it('dispatches nothing when no comments are deleteable', function () {
    Queue::fake([
        DeleteCommentEmail::class,
    ]);

    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => now(),
        ])
        ->create();

    artisan('app:delete-comment-email');

    Queue::assertPushedTimes(DeleteCommentEmail::class, 0);
});
