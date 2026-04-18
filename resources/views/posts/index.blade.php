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
        <x-post-list :posts="$posts" />
</x-layouts.app>
