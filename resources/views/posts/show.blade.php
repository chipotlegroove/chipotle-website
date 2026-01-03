<x-layouts.app>
    <div>
        <x-page-header :label="$post->title"/>
        <div class="text-sm text-gray-500">
            <p>Post created on: {{ $post->created_at->format("j F, Y") }}</p>
            <p>Post last updated on: {{ $post->updated_at->format("j F, Y") }}</p>
        </div>
        <p class="text-gray-600 mb-6">{{ $post->description }}</p>
        <div class="prose max-w-none">
            {!! str($post->body)->markdown()->sanitizeHtml()->toHtmlString() !!}
        </div>
    </div>
</x-layouts.app>
