<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class PostTagController extends Controller
{
    public function show(Tag $tag): View
    {
        $posts = $tag->posts()
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('posts-tags.show', [
            'posts' => $posts,
            'tag' => $tag,
        ]);
    }
}
