<x-layouts.app>
    <x-page-header label="Tags" />
    <div class="flex flex-col">
        @if (count($tags) > 0)
            @foreach ($tags as $tag)
                <a href="{{ route('posts-tags.show', $tag->slug) }}"
                    class="group flex justify-between py-6 px-2 border-b border-stone-400 hover:bg-light-brown hover:text-white cursor-pointer transition-colors duration-300">
                    <p>{{ ucwords($tag->label) }}</p>
                    <p class="text-sm text-stone-600 group-hover:text-white">{{ $tag->posts_count. ' posts' }}</p>
                </a>
            @endforeach
            <div class="mt-2">
                {{ $tags->links() }}
            </div>
        @else
            <x-no-results label="No categories available" />
        @endif
    </div>
</x-layouts.app>
