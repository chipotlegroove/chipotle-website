<?php

use App\Actions\FetchMonthOldCommentsWithEmail;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

it('returns only comments older than 30 days', function () {
    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => '2026-04-30',
        ])
        ->withEmail()
        ->create();

    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => Carbon::now(),
        ])
        ->withEmail()
        ->create();

    $comments = app(FetchMonthOldCommentsWithEmail::class)->handle();

    expect($comments)->toHaveLength(1);
});

it('does not include comments without email', function () {
    Comment::factory()
        ->for(Post::factory())
        ->state([
            'created_at' => '2026-04-30',
        ])
        ->create();

    $comments = app(FetchMonthOldCommentsWithEmail::class)->handle();

    expect($comments)->toBeEmpty();
});

it('returns an empty collection when no matching comments were found', function () {
    Comment::factory()
        ->for(Post::factory())
        ->withEmail()
        ->create();

    $comments = app(FetchMonthOldCommentsWithEmail::class)->handle();

    expect($comments)->toBeEmpty();
});
