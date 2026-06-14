<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tags = Tag::all();

        $selectedTags = $request->query('tags');
        $splittedTags = $selectedTags ? explode(',', $selectedTags) : [];

        $posts = Post::query()
            ->published()
            ->whereHas(
                'tags',
                fn ($q) => $splittedTags
                    ? $q->whereIn('slug', $splittedTags)
                    : $q,
            )
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('posts.index', [
            'posts' => $posts,
            'tags' => $tags,
            'splittedTags' => $splittedTags,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        if (! $post->published) {
            abort(404);
        }

        $key = $post->getKey();

        $comments = Comment::query()
            ->where('post_id', $key)
            ->whereNot('is_spam', true)
            ->whereNull('parent_id')
            ->with(['children'])
            ->paginate(15);

        return view('posts.show', compact('post', 'comments'));
    }
}
