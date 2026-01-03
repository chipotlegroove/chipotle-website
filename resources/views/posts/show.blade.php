<x-layouts.app>
    <div>
        <x-page-header :label="$post->title"/>
        <p class="text-gray-600 mb-6">{{ $post->description }}</p>
        {!! $post->body !!}
    </div>
</x-layouts.app>
