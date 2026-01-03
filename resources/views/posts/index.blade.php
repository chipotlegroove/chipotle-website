<x-layouts.app>
    <x-page-header label="Posts"/>
    <div class="grid grid-cols-4 grid-rows-2 grid-flow-row auto-rows-fr place-items-center gap-y-6 mb-4">
    @foreach($posts as $post)
        <x-card>
            <a href="{{ $post->getUrl() }}">
                <img src="https://placeholder.bg/mediumrectangle" alt="post-image">
                <div class="mt-4">
                    <p>{{ $post->title }}</p>
                    <p> Description </p>
                </div>
            </a>
        </x-card>
    @endforeach
    </div>
    {{ $posts->links() }}
</x-layouts.app>
