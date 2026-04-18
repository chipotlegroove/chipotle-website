@props(['posts', 'tags', 'splittedTags'])
<x-layouts.app>
    <div x-data="{
        splittedTags: @js($splittedTags),
        queryUrl: '/',
        buildQueryUrl(e) {
            const tags = e.detail;
            const joinedTags = tags.join();
            this.queryUrl = joinedTags.length > 0 ? '?tags=' + joinedTags : '/';
        },
        applyFilter() {
            window.location.href = this.queryUrl;
        }
    }">
        <div @tag-selected="buildQueryUrl">
            <x-toggleable-section label="Tags">
                <x-tags-list :tags=$tags :selectedTags="$splittedTags" />
                <div class="flex space-x-2 items-center mt-4">
                    <x-main-button type="button" @click="applyFilter" label="Filter" />
                    <x-cancel-button type="button" @click="$dispatch('reset-tags')" label="Reset" />
                </div>
            </x-toggleable-section>
        </div>
        <x-page-header label="Posts" />
        @if (count($posts) > 0)
            <div class="grid grid-cols-4 grid-rows-2 grid-flow-row auto-rows-fr place-items-center gap-y-6 mb-4">
                @foreach ($posts as $post)
                    <x-card>
                        <a href="{{ $post->getUrl() }}">
                            @if ($post->hasMedia('thumbnail'))
                                <img src="{{ $post->getFirstMediaUrl('thumbnail', 'thumbnail') }}" alt="post-image">
                            @else
                                <img src="{{ asset('images/no-thumbnail.webp') }}" alt="post-image">
                            @endif
                            <div class="mt-4">
                                <p class="font-bold">{{ $post->title }}</p>
                                <p>{{ $post->description ?? 'No description available.' }}</p>
                            </div>
                            <div class="mt-2">
                                @foreach ($post->tags as $tag)
                                    <x-tag-clip :label="$tag->label" />
                                @endforeach
                            </div>
                        </a>
                    </x-card>
                @endforeach
            </div>
            {{ $posts->links() }}
        @else
            <x-no-results label="No posts were found in this category" />
        @endif
</x-layouts.app>
