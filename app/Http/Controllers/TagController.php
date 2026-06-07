<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

final class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::query()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->paginate();

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }
}
