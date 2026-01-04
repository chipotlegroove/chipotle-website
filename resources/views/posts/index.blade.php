<x-layouts.app>
    <x-page-header label="Posts"/>
    <div class="grid grid-cols-4 grid-rows-2 grid-flow-row auto-rows-fr place-items-center gap-y-6 mb-4">
    @foreach($posts as $post)
        <x-card>
            <a href="{{ $post->getUrl() }}">
                @if($post->hasMedia("thumbnail"))
                <img src="{{ $post->getFirstMediaUrl("thumbnail","thumbnail") }}" alt="post-image">
                @else
                <img src="{{ asset('images/no-thumbnail.webp') }}" alt="post-image">
                @endif
                <div class="mt-4">
                    <p class="font-bold">{{ $post->title }}</p>
                    <p>{{ $post->description ?? "No description available." }}</p>
                </div>
            </a>
        </x-card>
    @endforeach
    </div>
    {{ $posts->links() }}
</x-layouts.app>
