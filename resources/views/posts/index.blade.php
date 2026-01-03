<x-layouts.app>
    Home
    @foreach($posts as $post)
        <div>
            <a href="{{ $post->getUrl() }}"><p>{{ $post->title }}</p></a>
        </div>
    @endforeach
</x-layouts.app>
