@props(['posts'])
@if (count($posts) > 0)
    <div x-data={} class="grid grid-cols-5 grid-rows-2 grid-flow-row auto-rows-fr place-items-center gap-y-6 mb-4">
        @foreach ($posts as $post)
            <x-card>
                <div @click="window.location='{{ $post->getUrl() }}'" class="flex flex-col h-full w-full cursor-pointer">
                    <div>
                        @if ($post->hasMedia('thumbnail'))
                            <img class="w-full rounded-3xl rounded-b-none"
                                src="{{ $post->getFirstMediaUrl('thumbnail', 'thumbnail') }}" alt="post-image">
                        @else
                            <img class="w-full rounded-3xl rounded-b-none" src="{{ asset('images/no-thumbnail.webp') }}"
                                alt="post-image">
                        @endif
                    </div>
                    <div class="flex flex-col p-4 pt-0 justify-between flex-1">
                        <div class="mt-4">
                            <p class="text-2xl font-bold">{{ $post->title }}</p>
                            <p class="text-sm text-gray-700 line-clamp-3">
                                {{ $post->description ?? 'No description available.' }}</p>
                        </div>
                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{route('posts-tags.show', $tag->slug)}}">
                                    <x-tag-clip :label="$tag->label" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
    {{ $posts->links() }}
@else
    <x-no-results label="No posts were found in this category" />
@endif
