<x-layouts.app>
<div x-data="{ 'replyId': 0 }">

    <section>
        <x-page-header :label="$post->title" />
        @if ($post->hasMedia('thumbnail'))
            <img src="{{ $post->getFirstMediaUrl('thumbnail') }}" alt="post-thumbnail" class="w-full mb-6 max-h-96">
        @endif
        <div class="text-sm text-gray-500">
            <p>Post created on: {{ $post->created_at->format('j F, Y') }}</p>
            <p>Post last updated on: {{ $post->updated_at->format('j F, Y') }}</p>
        </div>
        <p class="text-gray-600 mb-6">{{ $post->description }}</p>
        <div class="prose max-w-none">
            {!! str($post->body)->markdown()->sanitizeHtml()->toHtmlString() !!}
        </div>
    </section>
    <section class="mt-6">
        <x-page-header label="Comments" />
        <p>What did you think about this post? Let me know in the comments!</p>
        <x-comment-form action="/posts/{{ $post->id }}/comments"/>
        @include('comment-list', ['comments' => $comments, 'depth' => 0])
    </section>
</div>
</x-layouts.app>
