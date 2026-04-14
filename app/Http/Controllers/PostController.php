<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->published()
            ->with('tags')
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

        return view('posts.show', compact('post'));
    }
}
