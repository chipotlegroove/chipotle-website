<x-layouts.app>
    <x-page-header :label="ucwords($tag->label).' '.' Posts'"/>
    <x-post-list :posts="$posts" />
</x-layouts.app>
