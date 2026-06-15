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
        },
        open: false
    }">
        <div class="flex space-x-8">
            <x-page-header label="Posts" />
            <div>
                <div class="relative" @click.outside = "open = false">
                    <div @click = "open = !open"
                        class="group flex items-center cursor-pointer bg-white p-2 rounded-md hover:bg-gray-100 hover:text-black transition-all duration-300"
                        :class="{ 'bg-gray-100 text-black': open || splittedTags.length > 0 }">
                        <x-icon-filter />
                        <p class="max-w-0 overflow-hidden opacity-0 group-hover:ml-2 group-hover:max-w-xs group-hover:opacity-100 uppercase tracking-widest font-semibold text-sm transition-all duration-500 whitespace-nowrap"
                            :class="{ 'max-w-xs opacity-100 ml-2': open || splittedTags.length > 0 }">
                            Tags
                        </p>
                    </div>
                    <div x-cloak @tag-selected="buildQueryUrl"
                        class="absolute bg-white px-4 py-2 -top-12 left-24 rounded-xl shadow-sm border border-black/10 transition-all duration-300"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-4" x-show="open">
                        <x-tags-list :tags=$tags :selectedTags="$splittedTags" />
                        <div class="flex space-x-2 justify-center items-center mt-4">
                            <x-main-button class="text-xs" type="button" @click="applyFilter">
                                Filter
                            </x-main-button>
                            <x-cancel-button class="text-xs" type="button" @click="$dispatch('reset-tags')">
                                Cancel
                            </x-cancel-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-post-list :posts="$posts" />
</x-layouts.app>
