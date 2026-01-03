<x-layouts.app>
    Home
    @foreach($posts as $post)
        <div>
            <p>{{ $post->title }}</p>
            <p>{{ $post->body }}</p>
        </div>
        <div>
            testing
        </div>
    @endforeach
</x-layouts.app>
