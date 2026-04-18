<x-layouts.app>
    <x-page-header label="Tags" />
    <div class="border-collapse">
        @if (count($tags) > 0)
            @foreach ($tags as $tag)
                <div class="py-6 px-2 border-b border-gray-400 border-collapse hover:bg-sky-500 hover:text-white cursor-pointer transition-colors duration-300">
                    {{ ucwords($tag->label) }}
                </div>
            @endforeach
        @else
            <x-no-results label="No categories available"/>
        @endif
    </div>
</x-layouts.app>
