<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Builder;

class PostController extends Controller
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
            ->whereHas('tags', fn ($q) => $splittedTags ? $q->whereIn('slug', $splittedTags) : $q)
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

        $comments = Comment::withQueryConstraint(function (Builder $query) use ($post) {
            $query->where('comments.post_id', $post->getKey());
        }, function () {
            return Comment::tree()->get();
        })->toTree();

        return view('posts.show', compact('post', 'comments'));
    }
}
