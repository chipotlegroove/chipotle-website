<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\View\View;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Builder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->published()
            ->with(['tags'])
            ->orderByDesc('created_at')->paginate(12);

        return view('posts.index', compact('posts'));
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
