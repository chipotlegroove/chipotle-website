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
            ->when($splittedTags, function ($q) use ($splittedTags) {
                $q->whereHas(
                    'tags',
                    fn ($q) => $splittedTags
                        ? $q->whereIn('slug', $splittedTags)
                        : $q,
                );
            })
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
    public function show(Request $request, Post $post): View
    {
        if (! $post->published) {
            abort(404);
        }

        $key = $post->getKey();

        $selectedComment = $request->query('comment');

        // make sure comments is a paginated array even if its a single one to ensure page works for both cases
        $comments = $selectedComment
            ? ($comments = Comment::query()
                ->with('children')
                ->where('id', $selectedComment)
                ->paginate())
            : ($comments = Comment::query()
                ->where('post_id', $key)
                ->whereNot('is_spam', true)
                ->whereNull('parent_id')
                ->with(['children'])
                ->paginate(15));

        $newCommentId = session('newCommentId');

        if ($newCommentId) {
            $newComment = Comment::findOrFail($newCommentId);
            $commentToAdd = ! $newComment->parent_id
                ? $newComment
                : $newComment->rootAncestor;

            $items = $comments
                ->getCollection()
                ->reject(fn ($c) => $c->id === $commentToAdd->id)
                ->prepend($commentToAdd);

            $comments->setCollection($items);
        }

        return view(
            'posts.show',
            compact('post', 'comments', 'selectedComment'),
        );
    }
}
