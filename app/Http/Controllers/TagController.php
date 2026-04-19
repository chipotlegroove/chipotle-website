<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

final class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::all();

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }
}
